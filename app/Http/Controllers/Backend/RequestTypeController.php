<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RequestType;
use App\Repositories\Backend\RequestTypeRepository;
use App\Http\Requests\Backend\RequestType\ManageRequestTypeRequest;
use App\Http\Requests\Backend\RequestType\StoreRequestTypeRequest;
use App\Http\Requests\Backend\RequestType\UpdateRequestTypeRequest;

use App\Events\Frontend\RequestType\RequestTypeCreated;
use App\Events\Frontend\RequestType\RequestTypeUpdated;
use App\Events\Frontend\RequestType\RequestTypeDeleted;

use DataTables;

class RequestTypeController extends Controller
{
    /**
     * @var RequestTypeRepository
     */
    protected $request_typeRepository;

    /**
     * RequestTypeController constructor.
     *
     * @param RequestTypeRepository $request_typeRepository
     */
    public function __construct(RequestTypeRepository $request_typeRepository)
    {
        $this->request_typeRepository = $request_typeRepository;
    }

    /**
     * Display a listing of the resource.
     *
    * @param ManageRequestTypeRequest $request
    *
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(ManageRequestTypeRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = RequestType::selectRaw('request_types.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.request_types.show', $row) . '">' . e($row->name) . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View RequestType') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update RequestType') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete RequestType') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.request_type.index')
            ->withrequestTypes($this->request_typeRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageRequestTypeRequest    $request
     *
     * @return mixed
     */
    public function create(ManageRequestTypeRequest $request)
    {
        return view('backend.request_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequestTypeRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreRequestTypeRequest $request)
    {
        $requestType = $this->request_typeRepository->create($request->all());

        // Fire create event (RequestTypeCreated)
        event(new RequestTypeCreated($requestType));

        return redirect()->route('admin.request_types.index')
            ->withFlashSuccess(__('backend_request_types.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageRequestTypeRequest  $request
     * @param RequestType               $requestType
     *
     * @return mixed
     */
    public function show(ManageRequestTypeRequest $request, RequestType $requestType)
    {
        return view('backend.request_type.show')->withRequestType($requestType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageRequestTypeRequest $request
     * @param RequestType              $requestType
     *
     * @return mixed
     */
    public function edit(ManageRequestTypeRequest $request, RequestType $requestType)
    {
        return view('backend.request_type.edit')->withRequestType($requestType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequestTypeRequest  $request
     * @param RequestType               $requestType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateRequestTypeRequest $request, RequestType $requestType)
    {
        $updated = $this->request_typeRepository->update($requestType, $request->all());

        // Fire update event (RequestTypeUpdated)
        event(new RequestTypeUpdated($updated));

        return redirect()->route('admin.request_types.index')
            ->withFlashSuccess(__('backend_request_types.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageRequestTypeRequest $request
     * @param RequestType              $requestType
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageRequestTypeRequest $request, RequestType $requestType)
    {
        $this->request_typeRepository->deleteById($requestType->id);

        // Fire delete event (RequestTypeDeleted)
        event(new RequestTypeDeleted($requestType));

        return redirect()->route('admin.request_types.deleted')
            ->withFlashSuccess(__('backend_request_types.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageRequestTypeRequest $request
     * @param RequestType              $deletedRequestType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageRequestTypeRequest $request, $deletedRequestType)
    {
        // $this->request_typeRepository->forceDelete($deletedRequestType);
        $deletedRequestType->forceDelete();

        return redirect()->route('admin.request_types.index')
            ->withFlashSuccess(__('backend_request_types.alerts.deleted_permanently'));
    }

    /**
     * @param ManageRequestTypeRequest $request
     * @param RequestType              $deletedRequestType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageRequestTypeRequest $request, RequestType $deletedRequestType)
    {
        $this->request_typeRepository->restore($deletedRequestType);

        return redirect()->route('admin.request_types.index')
            ->withFlashSuccess(__('backend_request_types.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageRequestTypeRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageRequestTypeRequest $request)
    {
        return view('backend.request_type.deleted')
            ->withrequestTypes($this->request_typeRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}