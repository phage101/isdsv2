<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\OfficeType;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class OfficeTypeRepository.
 */
class OfficeTypeRepository extends BaseRepository
{
    /**
     * OfficeTypeRepository constructor.
     *
     * @param  OfficeType  $model
     */
    public function __construct(OfficeType $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return OfficeType::class;
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
     * @return OfficeType
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : OfficeType
    {
        return DB::transaction(function () use ($data) {
            $office_type = $this->model::create($data);

            if ($office_type) {
                return $office_type;
            }

            throw new GeneralException(__('backend_office_types.exceptions.create_error'));
        });
    }

    /**
     * @param OfficeType  $office_type
     * @param array     $data
     *
     * @return OfficeType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(OfficeType $office_type, array $data) : OfficeType
    {
        return DB::transaction(function () use ($office_type, $data) {
            if ($office_type->update($data)) {

                return $office_type;
            }

            throw new GeneralException(__('backend_office_types.exceptions.update_error'));
        });
    }

    /**
     * @param OfficeType $office_type
     *
     * @return OfficeType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(OfficeType $office_type) : OfficeType
    {
        if (is_null($office_type->deleted_at)) {
            throw new GeneralException(__('backend_office_types.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($office_type) {
            if ($office_type->forceDelete()) {
                return $office_type;
            }

            throw new GeneralException(__('backend_office_types.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param OfficeType $office_type
     *
     * @return OfficeType
     * @throws GeneralException
     */
    public function restore(OfficeType $office_type) : OfficeType
    {
        if (is_null($office_type->deleted_at)) {
            throw new GeneralException(__('backend_office_types.exceptions.cant_restore'));
        }

        if ($office_type->restore()) {
            return $office_type;
        }

        throw new GeneralException(__('backend_office_types.exceptions.restore_error'));
    }
}