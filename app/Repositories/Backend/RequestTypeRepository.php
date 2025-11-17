<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\RequestType;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class RequestTypeRepository.
 */
class RequestTypeRepository extends BaseRepository
{
    /**
     * RequestTypeRepository constructor.
     *
     * @param  RequestType  $model
     */
    public function __construct(RequestType $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return RequestType::class;
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
     * @return RequestType
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : RequestType
    {
        return DB::transaction(function () use ($data) {
            $request_type = $this->model::create($data);

            if ($request_type) {
                return $request_type;
            }

            throw new GeneralException(__('backend_request_types.exceptions.create_error'));
        });
    }

    /**
     * @param RequestType  $request_type
     * @param array     $data
     *
     * @return RequestType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(RequestType $request_type, array $data) : RequestType
    {
        return DB::transaction(function () use ($request_type, $data) {
            if ($request_type->update($data)) {

                return $request_type;
            }

            throw new GeneralException(__('backend_request_types.exceptions.update_error'));
        });
    }

    /**
     * @param RequestType $request_type
     *
     * @return RequestType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(RequestType $request_type) : RequestType
    {
        if (is_null($request_type->deleted_at)) {
            throw new GeneralException(__('backend_request_types.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($request_type) {
            if ($request_type->forceDelete()) {
                return $request_type;
            }

            throw new GeneralException(__('backend_request_types.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param RequestType $request_type
     *
     * @return RequestType
     * @throws GeneralException
     */
    public function restore(RequestType $request_type) : RequestType
    {
        if (is_null($request_type->deleted_at)) {
            throw new GeneralException(__('backend_request_types.exceptions.cant_restore'));
        }

        if ($request_type->restore()) {
            return $request_type;
        }

        throw new GeneralException(__('backend_request_types.exceptions.restore_error'));
    }
}