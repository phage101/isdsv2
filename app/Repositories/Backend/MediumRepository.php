<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Medium;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class MediumRepository.
 */
class MediumRepository extends BaseRepository
{
    /**
     * MediumRepository constructor.
     *
     * @param  Medium  $model
     */
    public function __construct(Medium $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Medium::class;
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
     * @return Medium
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Medium
    {
        return DB::transaction(function () use ($data) {
            $medium = $this->model::create($data);

            if ($medium) {
                return $medium;
            }

            throw new GeneralException(__('backend_media.exceptions.create_error'));
        });
    }

    /**
     * @param Medium  $medium
     * @param array     $data
     *
     * @return Medium
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Medium $medium, array $data) : Medium
    {
        return DB::transaction(function () use ($medium, $data) {
            if ($medium->update($data)) {

                return $medium;
            }

            throw new GeneralException(__('backend_media.exceptions.update_error'));
        });
    }

    /**
     * @param Medium $medium
     *
     * @return Medium
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Medium $medium) : Medium
    {
        if (is_null($medium->deleted_at)) {
            throw new GeneralException(__('backend_media.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($medium) {
            if ($medium->forceDelete()) {
                return $medium;
            }

            throw new GeneralException(__('backend_media.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Medium $medium
     *
     * @return Medium
     * @throws GeneralException
     */
    public function restore(Medium $medium) : Medium
    {
        if (is_null($medium->deleted_at)) {
            throw new GeneralException(__('backend_media.exceptions.cant_restore'));
        }

        if ($medium->restore()) {
            return $medium;
        }

        throw new GeneralException(__('backend_media.exceptions.restore_error'));
    }
}