<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Meeting;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class MeetingRepository.
 */
class MeetingRepository extends BaseRepository
{
    /**
     * MeetingRepository constructor.
     *
     * @param  Meeting  $model
     */
    public function __construct(Meeting $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Meeting::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Meeting
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Meeting
    {
        // Check for scheduling conflict before attempting create
        if (!empty($data['hosts_id']) && !empty($data['date_scheduled']) && !empty($data['time_start']) && !empty($data['time_end'])) {
            if ($this->hasScheduleConflict($data['hosts_id'], $data['date_scheduled'], $data['time_start'], $data['time_end'])) {
                throw new GeneralException(__('backend_meetings.exceptions.schedule_conflict'));
            }
        }

        $maxAttempts = 5;
        $attempt = 0;

        while ($attempt < $maxAttempts) {
            try {
                return DB::transaction(function () use ($data) {
                    $meeting = $this->model::create($data);

                    if ($meeting) {
                        return $meeting;
                    }

                    throw new GeneralException(__('backend_meetings.exceptions.create_error'));
                });
            } catch (\Illuminate\Database\QueryException $e) {
                // MySQL duplicate entry error code
                $mysqlError = isset($e->errorInfo[1]) ? $e->errorInfo[1] : null;
                if ($mysqlError === 1062) {
                    // Duplicate entry - regenerate request_number and retry
                    $data['request_number'] = \App\Models\Meeting::generateRequestNumber();
                    $attempt++;
                    // small backoff to reduce collision likelihood
                    usleep(100000);
                    continue;
                }

                throw $e;
            }
        }

        throw new GeneralException(__('backend_meetings.exceptions.create_error'));
    }

    /**
     * @param Meeting  $meeting
     * @param array     $data
     *
     * @return Meeting
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Meeting $meeting, array $data) : Meeting
    {
        // Determine effective scheduling values (incoming or existing)
        $hostsId = $data['hosts_id'] ?? $meeting->hosts_id;
        $date = $data['date_scheduled'] ?? $meeting->date_scheduled;
        $start = $data['time_start'] ?? $meeting->time_start;
        $end = $data['time_end'] ?? $meeting->time_end;

        if (!empty($hostsId) && !empty($date) && !empty($start) && !empty($end)) {
            if ($this->hasScheduleConflict($hostsId, $date, $start, $end, $meeting->id)) {
                throw new GeneralException(__('backend_meetings.exceptions.schedule_conflict'));
            }
        }

        return DB::transaction(function () use ($meeting, $data) {
            if ($meeting->update($data)) {

                return $meeting;
            }

            throw new GeneralException(__('backend_meetings.exceptions.update_error'));
        });
    }

    /**
     * Check whether a scheduling conflict exists for the given host/date/time range.
     *
     * @param int $hostsId
     * @param string $date
     * @param string $start (HH:MM)
     * @param string $end (HH:MM)
     * @param int|null $excludeId
     * @return bool
     */
    protected function hasScheduleConflict($hostsId, $date, $start, $end, $excludeId = null)
    {
        $query = Meeting::where('hosts_id', $hostsId)
            ->where('date_scheduled', $date)
            ->whereNotNull('time_start')
            ->whereNotNull('time_end');

        if ($excludeId) {
            $query->where('id', '<>', $excludeId);
        }

        // Time ranges overlap when: start < existing_end AND end > existing_start
        $query->whereRaw('? < time_end AND ? > time_start', [$start, $end]);

        return $query->exists();
    }

    /**
     * @param Meeting $meeting
     *
     * @return Meeting
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Meeting $meeting) : Meeting
    {
        if (is_null($meeting->deleted_at)) {
            throw new GeneralException(__('backend_meetings.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($meeting) {
            if ($meeting->forceDelete()) {
                return $meeting;
            }

            throw new GeneralException(__('backend_meetings.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Meeting $meeting
     *
     * @return Meeting
     * @throws GeneralException
     */
    public function restore(Meeting $meeting) : Meeting
    {
        if (is_null($meeting->deleted_at)) {
            throw new GeneralException(__('backend_meetings.exceptions.cant_restore'));
        }

        if ($meeting->restore()) {
            return $meeting;
        }

        throw new GeneralException(__('backend_meetings.exceptions.restore_error'));
    }
}