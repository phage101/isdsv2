<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Host;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class HostRepository.
 */
class HostRepository extends BaseRepository
{
    /**
     * HostRepository constructor.
     *
     * @param  Host  $model
     */
    public function __construct(Host $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Host::class;
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
     * @return Host
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Host
    {
        return DB::transaction(function () use ($data) {
            $host = $this->model::create($data);

            if ($host) {
                return $host;
            }

            throw new GeneralException(__('backend_hosts.exceptions.create_error'));
        });
    }

    /**
     * @param Host  $host
     * @param array     $data
     *
     * @return Host
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Host $host, array $data) : Host
    {
        return DB::transaction(function () use ($host, $data) {
            if ($host->update($data)) {

                return $host;
            }

            throw new GeneralException(__('backend_hosts.exceptions.update_error'));
        });
    }

    /**
     * @param Host $host
     *
     * @return Host
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Host $host) : Host
    {
        if (is_null($host->deleted_at)) {
            throw new GeneralException(__('backend_hosts.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($host) {
            if ($host->forceDelete()) {
                return $host;
            }

            throw new GeneralException(__('backend_hosts.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Host $host
     *
     * @return Host
     * @throws GeneralException
     */
    public function restore(Host $host) : Host
    {
        if (is_null($host->deleted_at)) {
            throw new GeneralException(__('backend_hosts.exceptions.cant_restore'));
        }

        if ($host->restore()) {
            return $host;
        }

        throw new GeneralException(__('backend_hosts.exceptions.restore_error'));
    }
}