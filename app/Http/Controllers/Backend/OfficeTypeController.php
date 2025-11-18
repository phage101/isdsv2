<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OfficeType;
use App\Repositories\Backend\OfficeTypeRepository;
use App\Http\Requests\Backend\OfficeType\ManageOfficeTypeRequest;
use App\Http\Requests\Backend\OfficeType\StoreOfficeTypeRequest;
use App\Http\Requests\Backend\OfficeType\UpdateOfficeTypeRequest;

use App\Events\Backend\OfficeType\OfficeTypeCreated;
use App\Events\Backend\OfficeType\OfficeTypeUpdated;
use App\Events\Backend\OfficeType\OfficeTypeDeleted;

use DataTables;

class OfficeTypeController extends Controller
{
    /**
     * @var OfficeTypeRepository
     */
    protected $office_typeRepository;

    /**
     * OfficeTypeController constructor.
     *
     * @param OfficeTypeRepository $office_typeRepository
     */
    public function __construct(OfficeTypeRepository $office_typeRepository)
    {
        $this->office_typeRepository = $office_typeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageOfficeTypeRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageOfficeTypeRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = OfficeType::selectRaw('office_types.*');

                // Handle search
                if ($request->has('search') && !empty($request->get('search')['value'])) {
                    $search = $request->get('search')['value'];
                    $query->where('name', 'like', "%{$search}%");
                }

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.office_types.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->editColumn('active', function ($row) {
                        return $row->active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View OfficeType') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update OfficeType') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete OfficeType') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action','active'])
                    ->make(true);
            }
        }

        return view('backend.office_type.index')
            ->withofficeTypes($this->office_typeRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageOfficeTypeRequest    $request
     *
     * @return mixed
     */
    public function create(ManageOfficeTypeRequest $request)
    {
        return view('backend.office_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOfficeTypeRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreOfficeTypeRequest $request)
    {
        $this->office_typeRepository->create($request->all());

        // Fire create event (OfficeTypeCreated)
        event(new OfficeTypeCreated($request));

        return redirect()->route('admin.office_types.index')
            ->withFlashSuccess(__('backend_office_types.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageOfficeTypeRequest  $request
     * @param OfficeType               $officeType
     *
     * @return mixed
     */
    public function show(ManageOfficeTypeRequest $request, OfficeType $officeType)
    {
        return view('backend.office_type.show')->withOfficeType($officeType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageOfficeTypeRequest $request
     * @param OfficeType              $officeType
     *
     * @return mixed
     */
    public function edit(ManageOfficeTypeRequest $request, OfficeType $officeType)
    {
        return view('backend.office_type.edit')->withOfficeType($officeType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOfficeTypeRequest  $request
     * @param OfficeType               $officeType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateOfficeTypeRequest $request, OfficeType $officeType)
    {
        $this->office_typeRepository->update($officeType, $request->all());

        // Fire update event (OfficeTypeUpdated)
        event(new OfficeTypeUpdated($request));

        return redirect()->route('admin.office_types.index')
            ->withFlashSuccess(__('backend_office_types.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageOfficeTypeRequest $request
     * @param OfficeType              $officeType
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageOfficeTypeRequest $request, OfficeType $officeType)
    {
        $this->office_typeRepository->deleteById($officeType->id);

        // Fire delete event (OfficeTypeDeleted)
        event(new OfficeTypeDeleted($request));

        return redirect()->route('admin.office_types.deleted')
            ->withFlashSuccess(__('backend_office_types.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageOfficeTypeRequest $request
     * @param OfficeType              $deletedOfficeType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageOfficeTypeRequest $request, $deletedOfficeType)
    {
        // $this->office_typeRepository->forceDelete($deletedOfficeType);
        $deletedOfficeType->forceDelete();

        return redirect()->route('admin.office_types.index')
            ->withFlashSuccess(__('backend_office_types.alerts.deleted_permanently'));
    }

    /**
     * @param ManageOfficeTypeRequest $request
     * @param OfficeType              $deletedOfficeType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageOfficeTypeRequest $request, OfficeType $deletedOfficeType)
    {
        $this->office_typeRepository->restore($deletedOfficeType);

        return redirect()->route('admin.office_types.index')
            ->withFlashSuccess(__('backend_office_types.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageOfficeTypeRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageOfficeTypeRequest $request)
    {
        return view('backend.office_type.deleted')
            ->withofficeTypes($this->office_typeRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}