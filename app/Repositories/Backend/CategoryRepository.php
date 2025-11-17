<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param  Category  $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Category::class;
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
     * @return Category
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Category
    {
        return DB::transaction(function () use ($data) {
            $category = $this->model::create($data);

            if ($category) {
                return $category;
            }

            throw new GeneralException(__('backend_categories.exceptions.create_error'));
        });
    }

    /**
     * @param Category  $category
     * @param array     $data
     *
     * @return Category
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Category $category, array $data) : Category
    {
        return DB::transaction(function () use ($category, $data) {
            if ($category->update($data)) {

                return $category;
            }

            throw new GeneralException(__('backend_categories.exceptions.update_error'));
        });
    }

    /**
     * @param Category $category
     *
     * @return Category
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Category $category) : Category
    {
        if (is_null($category->deleted_at)) {
            throw new GeneralException(__('backend_categories.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($category) {
            if ($category->forceDelete()) {
                return $category;
            }

            throw new GeneralException(__('backend_categories.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Category $category
     *
     * @return Category
     * @throws GeneralException
     */
    public function restore(Category $category) : Category
    {
        if (is_null($category->deleted_at)) {
            throw new GeneralException(__('backend_categories.exceptions.cant_restore'));
        }

        if ($category->restore()) {
            return $category;
        }

        throw new GeneralException(__('backend_categories.exceptions.restore_error'));
    }
}