<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Status;
use App\Repositories\Backend\StatusRepository;
use App\Http\Requests\Backend\Status\ManageStatusRequest;
use App\Http\Requests\Backend\Status\StoreStatusRequest;
use App\Http\Requests\Backend\Status\UpdateStatusRequest;

use App\Events\Backend\Status\StatusCreated;
use App\Events\Backend\Status\StatusUpdated;
use App\Events\Backend\Status\StatusDeleted;

use DataTables;

class StatusController extends Controller
{
    /**
     * @var StatusRepository
     */
    protected $statusRepository;

    /**
     * StatusController constructor.
     *
     * @param StatusRepository $statusRepository
     */
    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageStatusRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageStatusRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Status::selectRaw('statuses.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.statuses.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View Status') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update Status') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete Status') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.status.index')
            ->withstatuses($this->statusRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageStatusRequest    $request
     *
     * @return mixed
     */
    public function create(ManageStatusRequest $request)
    {
        return view('backend.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStatusRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreStatusRequest $request)
    {
        $this->statusRepository->create($request->all());

        // Fire create event (StatusCreated)
        event(new StatusCreated($request));

        return redirect()->route('admin.statuses.index')
            ->withFlashSuccess(__('backend_statuses.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageStatusRequest  $request
     * @param Status               $status
     *
     * @return mixed
     */
    public function show(ManageStatusRequest $request, Status $status)
    {
        return view('backend.status.show')->withStatus($status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageStatusRequest $request
     * @param Status              $status
     *
     * @return mixed
     */
    public function edit(ManageStatusRequest $request, Status $status)
    {
        return view('backend.status.edit')->withStatus($status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStatusRequest  $request
     * @param Status               $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        $this->statusRepository->update($status, $request->all());

        // Fire update event (StatusUpdated)
        event(new StatusUpdated($request));

        return redirect()->route('admin.statuses.index')
            ->withFlashSuccess(__('backend_statuses.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageStatusRequest $request
     * @param Status              $status
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageStatusRequest $request, Status $status)
    {
        $this->statusRepository->deleteById($status->id);

        // Fire delete event (StatusDeleted)
        event(new StatusDeleted($request));

        return redirect()->route('admin.statuses.deleted')
            ->withFlashSuccess(__('backend_statuses.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageStatusRequest $request
     * @param Status              $deletedStatus
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageStatusRequest $request, $deletedStatus)
    {
        // $this->statusRepository->forceDelete($deletedStatus);
        $deletedStatus->forceDelete();

        return redirect()->route('admin.statuses.index')
            ->withFlashSuccess(__('backend_statuses.alerts.deleted_permanently'));
    }

    /**
     * @param ManageStatusRequest $request
     * @param Status              $deletedStatus
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageStatusRequest $request, Status $deletedStatus)
    {
        $this->statusRepository->restore($deletedStatus);

        return redirect()->route('admin.statuses.index')
            ->withFlashSuccess(__('backend_statuses.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageStatusRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageStatusRequest $request)
    {
        return view('backend.status.deleted')
            ->withstatuses($this->statusRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}