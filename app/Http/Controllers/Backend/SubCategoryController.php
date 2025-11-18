<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubCategory;
use App\Models\Category;
use App\Repositories\Backend\SubCategoryRepository;
use App\Http\Requests\Backend\SubCategory\ManageSubCategoryRequest;
use App\Http\Requests\Backend\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Backend\SubCategory\UpdateSubCategoryRequest;

use App\Events\Frontend\SubCategory\SubCategoryCreated;
use App\Events\Frontend\SubCategory\SubCategoryUpdated;
use App\Events\Frontend\SubCategory\SubCategoryDeleted;

use DataTables;

class SubCategoryController extends Controller
{
    /**
     * @var SubCategoryRepository
     */
    protected $sub_categoryRepository;

    /**
     * SubCategoryController constructor.
     *
     * @param SubCategoryRepository $sub_categoryRepository
     */
    public function __construct(SubCategoryRepository $sub_categoryRepository)
    {
        $this->sub_categoryRepository = $sub_categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
    * @param ManageSubCategoryRequest $request
    *
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(ManageSubCategoryRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = SubCategory::selectRaw('sub_categories.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.sub_categories.show', $row) . '">' . e($row->name) . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View SubCategory') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update SubCategory') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete SubCategory') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.sub_category.index')
            ->withsubCategories($this->sub_categoryRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageSubCategoryRequest    $request
     *
     * @return mixed
     */
    public function create(ManageSubCategoryRequest $request)
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('backend.sub_category.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubCategoryRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $subCategory = $this->sub_categoryRepository->create($request->all());

        // Fire create event (SubCategoryCreated)
        event(new SubCategoryCreated($subCategory));

        return redirect()->route('admin.sub_categories.index')
            ->withFlashSuccess(__('backend_sub_categories.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageSubCategoryRequest  $request
     * @param SubCategory               $subCategory
     *
     * @return mixed
     */
    public function show(ManageSubCategoryRequest $request, SubCategory $subCategory)
    {
        return view('backend.sub_category.show')->withSubCategory($subCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageSubCategoryRequest $request
     * @param SubCategory              $subCategory
     *
     * @return mixed
     */
    public function edit(ManageSubCategoryRequest $request, SubCategory $subCategory)
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('backend.sub_category.edit')->withSubCategory($subCategory)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubCategoryRequest  $request
     * @param SubCategory               $subCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $updated = $this->sub_categoryRepository->update($subCategory, $request->all());

        // Fire update event (SubCategoryUpdated)
        event(new SubCategoryUpdated($updated));

        return redirect()->route('admin.sub_categories.index')
            ->withFlashSuccess(__('backend_sub_categories.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageSubCategoryRequest $request
     * @param SubCategory              $subCategory
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageSubCategoryRequest $request, SubCategory $subCategory)
    {
        $this->sub_categoryRepository->deleteById($subCategory->id);

        // Fire delete event (SubCategoryDeleted)
        event(new SubCategoryDeleted($subCategory));

        return redirect()->route('admin.sub_categories.deleted')
            ->withFlashSuccess(__('backend_sub_categories.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageSubCategoryRequest $request
     * @param SubCategory              $deletedSubCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageSubCategoryRequest $request, $deletedSubCategory)
    {
        // $this->sub_categoryRepository->forceDelete($deletedSubCategory);
        $deletedSubCategory->forceDelete();

        return redirect()->route('admin.sub_categories.index')
            ->withFlashSuccess(__('backend_sub_categories.alerts.deleted_permanently'));
    }

    /**
     * @param ManageSubCategoryRequest $request
     * @param SubCategory              $deletedSubCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageSubCategoryRequest $request, SubCategory $deletedSubCategory)
    {
        $this->sub_categoryRepository->restore($deletedSubCategory);

        return redirect()->route('admin.sub_categories.index')
            ->withFlashSuccess(__('backend_sub_categories.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageSubCategoryRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageSubCategoryRequest $request)
    {
        return view('backend.sub_category.deleted')
            ->withsubCategories($this->sub_categoryRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}