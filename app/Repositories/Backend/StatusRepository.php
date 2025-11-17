<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Status;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class StatusRepository.
 */
class StatusRepository extends BaseRepository
{
    /**
     * StatusRepository constructor.
     *
     * @param  Status  $model
     */
    public function __construct(Status $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Status::class;
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
     * @return Status
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Status
    {
        return DB::transaction(function () use ($data) {
            $status = $this->model::create($data);

            if ($status) {
                return $status;
            }

            throw new GeneralException(__('backend_statuses.exceptions.create_error'));
        });
    }

    /**
     * @param Status  $status
     * @param array     $data
     *
     * @return Status
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Status $status, array $data) : Status
    {
        return DB::transaction(function () use ($status, $data) {
            if ($status->update($data)) {

                return $status;
            }

            throw new GeneralException(__('backend_statuses.exceptions.update_error'));
        });
    }

    /**
     * @param Status $status
     *
     * @return Status
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Status $status) : Status
    {
        if (is_null($status->deleted_at)) {
            throw new GeneralException(__('backend_statuses.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($status) {
            if ($status->forceDelete()) {
                return $status;
            }

            throw new GeneralException(__('backend_statuses.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Status $status
     *
     * @return Status
     * @throws GeneralException
     */
    public function restore(Status $status) : Status
    {
        if (is_null($status->deleted_at)) {
            throw new GeneralException(__('backend_statuses.exceptions.cant_restore'));
        }

        if ($status->restore()) {
            return $status;
        }

        throw new GeneralException(__('backend_statuses.exceptions.restore_error'));
    }
}