<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PriorityLevel;
use App\Repositories\Backend\PriorityLevelRepository;
use App\Http\Requests\Backend\PriorityLevel\ManagePriorityLevelRequest;
use App\Http\Requests\Backend\PriorityLevel\StorePriorityLevelRequest;
use App\Http\Requests\Backend\PriorityLevel\UpdatePriorityLevelRequest;

use App\Events\Backend\PriorityLevel\PriorityLevelCreated;
use App\Events\Backend\PriorityLevel\PriorityLevelUpdated;
use App\Events\Backend\PriorityLevel\PriorityLevelDeleted;

use DataTables;

class PriorityLevelController extends Controller
{
    /**
     * @var PriorityLevelRepository
     */
    protected $priority_levelRepository;

    /**
     * PriorityLevelController constructor.
     *
     * @param PriorityLevelRepository $priority_levelRepository
     */
    public function __construct(PriorityLevelRepository $priority_levelRepository)
    {
        $this->priority_levelRepository = $priority_levelRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManagePriorityLevelRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManagePriorityLevelRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = PriorityLevel::selectRaw('priority_levels.*');

                // Handle search
                if ($request->has('search') && !empty($request->get('search')['value'])) {
                    $search = $request->get('search')['value'];
                    $query->where('priority_levels.name', 'like', "%{$search}%");
                }

                return DataTables::of($query)
                    ->editColumn('name', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.priority_levels.show', $row) . '">' . $row->name . "</a></span>";
                    })
                    ->editColumn('active', function ($row) {
                        return $row->active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View PriorityLevel') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update PriorityLevel') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete PriorityLevel') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['name','action','active'])
                    ->make(true);
            }
        }

        return view('backend.priority_level.index')
            ->withpriorityLevels($this->priority_levelRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManagePriorityLevelRequest    $request
     *
     * @return mixed
     */
    public function create(ManagePriorityLevelRequest $request)
    {
        return view('backend.priority_level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePriorityLevelRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StorePriorityLevelRequest $request)
    {
        $this->priority_levelRepository->create($request->all());

        // Fire create event (PriorityLevelCreated)
        event(new PriorityLevelCreated($request));

        return redirect()->route('admin.priority_levels.index')
            ->withFlashSuccess(__('backend_priority_levels.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManagePriorityLevelRequest  $request
     * @param PriorityLevel               $priorityLevel
     *
     * @return mixed
     */
    public function show(ManagePriorityLevelRequest $request, PriorityLevel $priorityLevel)
    {
        return view('backend.priority_level.show')->withPriorityLevel($priorityLevel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManagePriorityLevelRequest $request
     * @param PriorityLevel              $priorityLevel
     *
     * @return mixed
     */
    public function edit(ManagePriorityLevelRequest $request, PriorityLevel $priorityLevel)
    {
        return view('backend.priority_level.edit')->withPriorityLevel($priorityLevel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePriorityLevelRequest  $request
     * @param PriorityLevel               $priorityLevel
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdatePriorityLevelRequest $request, PriorityLevel $priorityLevel)
    {
        $this->priority_levelRepository->update($priorityLevel, $request->all());

        // Fire update event (PriorityLevelUpdated)
        event(new PriorityLevelUpdated($request));

        return redirect()->route('admin.priority_levels.index')
            ->withFlashSuccess(__('backend_priority_levels.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagePriorityLevelRequest $request
     * @param PriorityLevel              $priorityLevel
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManagePriorityLevelRequest $request, PriorityLevel $priorityLevel)
    {
        $this->priority_levelRepository->deleteById($priorityLevel->id);

        // Fire delete event (PriorityLevelDeleted)
        event(new PriorityLevelDeleted($request));

        return redirect()->route('admin.priority_levels.deleted')
            ->withFlashSuccess(__('backend_priority_levels.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManagePriorityLevelRequest $request
     * @param PriorityLevel              $deletedPriorityLevel
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManagePriorityLevelRequest $request, $deletedPriorityLevel)
    {
        // $this->priority_levelRepository->forceDelete($deletedPriorityLevel);
        $deletedPriorityLevel->forceDelete();

        return redirect()->route('admin.priority_levels.index')
            ->withFlashSuccess(__('backend_priority_levels.alerts.deleted_permanently'));
    }

    /**
     * @param ManagePriorityLevelRequest $request
     * @param PriorityLevel              $deletedPriorityLevel
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManagePriorityLevelRequest $request, PriorityLevel $deletedPriorityLevel)
    {
        $this->priority_levelRepository->restore($deletedPriorityLevel);

        return redirect()->route('admin.priority_levels.index')
            ->withFlashSuccess(__('backend_priority_levels.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManagePriorityLevelRequest $request
     *
     * @return mixed
     */
    public function deleted(ManagePriorityLevelRequest $request)
    {
        return view('backend.priority_level.deleted')
            ->withpriorityLevels($this->priority_levelRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}