<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\RequestType;
use App\Repositories\Backend\CategoryRepository;
use App\Http\Requests\Backend\Category\ManageCategoryRequest;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;

use App\Events\Frontend\Category\CategoryCreated;
use App\Events\Frontend\Category\CategoryUpdated;
use App\Events\Frontend\Category\CategoryDeleted;

use DataTables;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
    * @param ManageCategoryRequest $request
    *
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(ManageCategoryRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Category::selectRaw('categories.*');

                // Handle search
                if ($request->has('search') && !empty($request->get('search')['value'])) {
                    $search = $request->get('search')['value'];
                    $query->where('categories.name', 'like', "%{$search}%");
                }

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.categories.show', $row) . '">' . e($row->name) . "</a></span>";
                    })
                    ->editColumn('active', function ($row) {
                        if (isset($row->active)) {
                            return $row->active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                        }
                        return '<span class="badge badge-secondary">N/A</span>';
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View Category') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update Category') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete Category') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action','active'])
                    ->make(true);
            }
        }

        return view('backend.category.index')
            ->withcategories($this->categoryRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageCategoryRequest    $request
     *
     * @return mixed
     */
    public function create(ManageCategoryRequest $request)
    {
        $requestTypes = RequestType::orderBy('name')->pluck('name', 'id');
        return view('backend.category.create')->withRequestTypes($requestTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->all());

        // Fire create event (CategoryCreated)
        event(new CategoryCreated($category));

        return redirect()->route('admin.categories.index')
            ->withFlashSuccess(__('backend_categories.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageCategoryRequest  $request
     * @param Category               $category
     *
     * @return mixed
     */
    public function show(ManageCategoryRequest $request, Category $category)
    {
        return view('backend.category.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageCategoryRequest $request
     * @param Category              $category
     *
     * @return mixed
     */
    public function edit(ManageCategoryRequest $request, Category $category)
    {
        $requestTypes = RequestType::orderBy('name')->pluck('name', 'id');
        return view('backend.category.edit')->withCategory($category)->withRequestTypes($requestTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest  $request
     * @param Category               $category
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $updated = $this->categoryRepository->update($category, $request->all());

        // Fire update event (CategoryUpdated)
        event(new CategoryUpdated($updated));

        return redirect()->route('admin.categories.index')
            ->withFlashSuccess(__('backend_categories.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageCategoryRequest $request
     * @param Category              $category
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageCategoryRequest $request, Category $category)
    {
        $this->categoryRepository->deleteById($category->id);

        // Fire delete event (CategoryDeleted)
        event(new CategoryDeleted($category));

        return redirect()->route('admin.categories.deleted')
            ->withFlashSuccess(__('backend_categories.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageCategoryRequest $request
     * @param Category              $deletedCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageCategoryRequest $request, $deletedCategory)
    {
        // $this->categoryRepository->forceDelete($deletedCategory);
        $deletedCategory->forceDelete();

        return redirect()->route('admin.categories.index')
            ->withFlashSuccess(__('backend_categories.alerts.deleted_permanently'));
    }

    /**
     * @param ManageCategoryRequest $request
     * @param Category              $deletedCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageCategoryRequest $request, Category $deletedCategory)
    {
        $this->categoryRepository->restore($deletedCategory);

        return redirect()->route('admin.categories.index')
            ->withFlashSuccess(__('backend_categories.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageCategoryRequest $request)
    {
        return view('backend.category.deleted')
            ->withcategories($this->categoryRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}