<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Host;
use App\Repositories\Backend\HostRepository;
use App\Http\Requests\Backend\Host\ManageHostRequest;
use App\Http\Requests\Backend\Host\StoreHostRequest;
use App\Http\Requests\Backend\Host\UpdateHostRequest;

use App\Events\Backend\Host\HostCreated;
use App\Events\Backend\Host\HostUpdated;
use App\Events\Backend\Host\HostDeleted;

use DataTables;

class HostController extends Controller
{
    /**
     * @var HostRepository
     */
    protected $hostRepository;

    /**
     * HostController constructor.
     *
     * @param HostRepository $hostRepository
     */
    public function __construct(HostRepository $hostRepository)
    {
        $this->hostRepository = $hostRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageHostRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageHostRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Host::selectRaw('hosts.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.hosts.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View Host') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update Host') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete Host') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.host.index')
            ->withhosts($this->hostRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageHostRequest    $request
     *
     * @return mixed
     */
    public function create(ManageHostRequest $request)
    {
        return view('backend.host.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHostRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreHostRequest $request)
    {
        $this->hostRepository->create($request->all());

        // Fire create event (HostCreated)
        event(new HostCreated($request));

        return redirect()->route('admin.hosts.index')
            ->withFlashSuccess(__('backend_hosts.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageHostRequest  $request
     * @param Host               $host
     *
     * @return mixed
     */
    public function show(ManageHostRequest $request, Host $host)
    {
        return view('backend.host.show')->withHost($host);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageHostRequest $request
     * @param Host              $host
     *
     * @return mixed
     */
    public function edit(ManageHostRequest $request, Host $host)
    {
        return view('backend.host.edit')->withHost($host);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHostRequest  $request
     * @param Host               $host
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateHostRequest $request, Host $host)
    {
        $this->hostRepository->update($host, $request->all());

        // Fire update event (HostUpdated)
        event(new HostUpdated($request));

        return redirect()->route('admin.hosts.index')
            ->withFlashSuccess(__('backend_hosts.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageHostRequest $request
     * @param Host              $host
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageHostRequest $request, Host $host)
    {
        $this->hostRepository->deleteById($host->id);

        // Fire delete event (HostDeleted)
        event(new HostDeleted($request));

        return redirect()->route('admin.hosts.deleted')
            ->withFlashSuccess(__('backend_hosts.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageHostRequest $request
     * @param Host              $deletedHost
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageHostRequest $request, $deletedHost)
    {
        // $this->hostRepository->forceDelete($deletedHost);
        $deletedHost->forceDelete();

        return redirect()->route('admin.hosts.index')
            ->withFlashSuccess(__('backend_hosts.alerts.deleted_permanently'));
    }

    /**
     * @param ManageHostRequest $request
     * @param Host              $deletedHost
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageHostRequest $request, Host $deletedHost)
    {
        $this->hostRepository->restore($deletedHost);

        return redirect()->route('admin.hosts.index')
            ->withFlashSuccess(__('backend_hosts.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageHostRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageHostRequest $request)
    {
        return view('backend.host.deleted')
            ->withhosts($this->hostRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}