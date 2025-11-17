<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\PriorityLevel;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class PriorityLevelRepository.
 */
class PriorityLevelRepository extends BaseRepository
{
    /**
     * PriorityLevelRepository constructor.
     *
     * @param  PriorityLevel  $model
     */
    public function __construct(PriorityLevel $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return PriorityLevel::class;
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
     * @return PriorityLevel
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : PriorityLevel
    {
        return DB::transaction(function () use ($data) {
            $priority_level = $this->model::create($data);

            if ($priority_level) {
                return $priority_level;
            }

            throw new GeneralException(__('backend_priority_levels.exceptions.create_error'));
        });
    }

    /**
     * @param PriorityLevel  $priority_level
     * @param array     $data
     *
     * @return PriorityLevel
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(PriorityLevel $priority_level, array $data) : PriorityLevel
    {
        return DB::transaction(function () use ($priority_level, $data) {
            if ($priority_level->update($data)) {

                return $priority_level;
            }

            throw new GeneralException(__('backend_priority_levels.exceptions.update_error'));
        });
    }

    /**
     * @param PriorityLevel $priority_level
     *
     * @return PriorityLevel
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(PriorityLevel $priority_level) : PriorityLevel
    {
        if (is_null($priority_level->deleted_at)) {
            throw new GeneralException(__('backend_priority_levels.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($priority_level) {
            if ($priority_level->forceDelete()) {
                return $priority_level;
            }

            throw new GeneralException(__('backend_priority_levels.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param PriorityLevel $priority_level
     *
     * @return PriorityLevel
     * @throws GeneralException
     */
    public function restore(PriorityLevel $priority_level) : PriorityLevel
    {
        if (is_null($priority_level->deleted_at)) {
            throw new GeneralException(__('backend_priority_levels.exceptions.cant_restore'));
        }

        if ($priority_level->restore()) {
            return $priority_level;
        }

        throw new GeneralException(__('backend_priority_levels.exceptions.restore_error'));
    }
}