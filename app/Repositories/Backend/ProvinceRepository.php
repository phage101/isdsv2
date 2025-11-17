<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Province;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class ProvinceRepository.
 */
class ProvinceRepository extends BaseRepository
{
    /**
     * ProvinceRepository constructor.
     *
     * @param  Province  $model
     */
    public function __construct(Province $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Province::class;
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
     * @return Province
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Province
    {
        return DB::transaction(function () use ($data) {
            $province = $this->model::create($data);

            if ($province) {
                return $province;
            }

            throw new GeneralException(__('backend_provinces.exceptions.create_error'));
        });
    }

    /**
     * @param Province  $province
     * @param array     $data
     *
     * @return Province
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Province $province, array $data) : Province
    {
        return DB::transaction(function () use ($province, $data) {
            if ($province->update($data)) {

                return $province;
            }

            throw new GeneralException(__('backend_provinces.exceptions.update_error'));
        });
    }

    /**
     * @param Province $province
     *
     * @return Province
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Province $province) : Province
    {
        if (is_null($province->deleted_at)) {
            throw new GeneralException(__('backend_provinces.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($province) {
            if ($province->forceDelete()) {
                return $province;
            }

            throw new GeneralException(__('backend_provinces.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Province $province
     *
     * @return Province
     * @throws GeneralException
     */
    public function restore(Province $province) : Province
    {
        if (is_null($province->deleted_at)) {
            throw new GeneralException(__('backend_provinces.exceptions.cant_restore'));
        }

        if ($province->restore()) {
            return $province;
        }

        throw new GeneralException(__('backend_provinces.exceptions.restore_error'));
    }
}