<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Medium;
use App\Repositories\Backend\MediumRepository;
use App\Http\Requests\Backend\Medium\ManageMediumRequest;
use App\Http\Requests\Backend\Medium\StoreMediumRequest;
use App\Http\Requests\Backend\Medium\UpdateMediumRequest;

use App\Events\Backend\Medium\MediumCreated;
use App\Events\Backend\Medium\MediumUpdated;
use App\Events\Backend\Medium\MediumDeleted;

use DataTables;

class MediumController extends Controller
{
    /**
     * @var MediumRepository
     */
    protected $mediumRepository;

    /**
     * MediumController constructor.
     *
     * @param MediumRepository $mediumRepository
     */
    public function __construct(MediumRepository $mediumRepository)
    {
        $this->mediumRepository = $mediumRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageMediumRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageMediumRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Medium::selectRaw('media.*');

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.media.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View Medium') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update Medium') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete Medium') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
        }

        return view('backend.medium.index')
            ->withmedia($this->mediumRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageMediumRequest    $request
     *
     * @return mixed
     */
    public function create(ManageMediumRequest $request)
    {
        return view('backend.medium.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMediumRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreMediumRequest $request)
    {
        $this->mediumRepository->create($request->all());

        // Fire create event (MediumCreated)
        event(new MediumCreated($request));

        return redirect()->route('admin.media.index')
            ->withFlashSuccess(__('backend_media.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageMediumRequest  $request
     * @param Medium               $medium
     *
     * @return mixed
     */
    public function show(ManageMediumRequest $request, Medium $medium)
    {
        return view('backend.medium.show')->withMedium($medium);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageMediumRequest $request
     * @param Medium              $medium
     *
     * @return mixed
     */
    public function edit(ManageMediumRequest $request, Medium $medium)
    {
        return view('backend.medium.edit')->withMedium($medium);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMediumRequest  $request
     * @param Medium               $medium
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateMediumRequest $request, Medium $medium)
    {
        $this->mediumRepository->update($medium, $request->all());

        // Fire update event (MediumUpdated)
        event(new MediumUpdated($request));

        return redirect()->route('admin.media.index')
            ->withFlashSuccess(__('backend_media.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageMediumRequest $request
     * @param Medium              $medium
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageMediumRequest $request, Medium $medium)
    {
        $this->mediumRepository->deleteById($medium->id);

        // Fire delete event (MediumDeleted)
        event(new MediumDeleted($request));

        return redirect()->route('admin.media.deleted')
            ->withFlashSuccess(__('backend_media.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageMediumRequest $request
     * @param Medium              $deletedMedium
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageMediumRequest $request, $deletedMedium)
    {
        // $this->mediumRepository->forceDelete($deletedMedium);
        $deletedMedium->forceDelete();

        return redirect()->route('admin.media.index')
            ->withFlashSuccess(__('backend_media.alerts.deleted_permanently'));
    }

    /**
     * @param ManageMediumRequest $request
     * @param Medium              $deletedMedium
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageMediumRequest $request, Medium $deletedMedium)
    {
        $this->mediumRepository->restore($deletedMedium);

        return redirect()->route('admin.media.index')
            ->withFlashSuccess(__('backend_media.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageMediumRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageMediumRequest $request)
    {
        return view('backend.medium.deleted')
            ->withmedia($this->mediumRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}