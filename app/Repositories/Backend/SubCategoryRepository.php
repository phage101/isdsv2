<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\SubCategory;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class SubCategoryRepository.
 */
class SubCategoryRepository extends BaseRepository
{
    /**
     * SubCategoryRepository constructor.
     *
     * @param  SubCategory  $model
     */
    public function __construct(SubCategory $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return SubCategory::class;
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
     * @return SubCategory
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : SubCategory
    {
        return DB::transaction(function () use ($data) {
            $sub_category = $this->model::create($data);

            if ($sub_category) {
                return $sub_category;
            }

            throw new GeneralException(__('backend_sub_categories.exceptions.create_error'));
        });
    }

    /**
     * @param SubCategory  $sub_category
     * @param array     $data
     *
     * @return SubCategory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(SubCategory $sub_category, array $data) : SubCategory
    {
        return DB::transaction(function () use ($sub_category, $data) {
            if ($sub_category->update($data)) {

                return $sub_category;
            }

            throw new GeneralException(__('backend_sub_categories.exceptions.update_error'));
        });
    }

    /**
     * @param SubCategory $sub_category
     *
     * @return SubCategory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(SubCategory $sub_category) : SubCategory
    {
        if (is_null($sub_category->deleted_at)) {
            throw new GeneralException(__('backend_sub_categories.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($sub_category) {
            if ($sub_category->forceDelete()) {
                return $sub_category;
            }

            throw new GeneralException(__('backend_sub_categories.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param SubCategory $sub_category
     *
     * @return SubCategory
     * @throws GeneralException
     */
    public function restore(SubCategory $sub_category) : SubCategory
    {
        if (is_null($sub_category->deleted_at)) {
            throw new GeneralException(__('backend_sub_categories.exceptions.cant_restore'));
        }

        if ($sub_category->restore()) {
            return $sub_category;
        }

        throw new GeneralException(__('backend_sub_categories.exceptions.restore_error'));
    }
}