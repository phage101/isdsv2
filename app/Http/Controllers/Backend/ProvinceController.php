<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Province;
use App\Repositories\Backend\ProvinceRepository;
use App\Http\Requests\Backend\Province\ManageProvinceRequest;
use App\Http\Requests\Backend\Province\StoreProvinceRequest;
use App\Http\Requests\Backend\Province\UpdateProvinceRequest;

use App\Events\Backend\Province\ProvinceCreated;
use App\Events\Backend\Province\ProvinceUpdated;
use App\Events\Backend\Province\ProvinceDeleted;

use DataTables;

class ProvinceController extends Controller
{
    /**
     * @var ProvinceRepository
     */
    protected $provinceRepository;

    /**
     * ProvinceController constructor.
     *
     * @param ProvinceRepository $provinceRepository
     */
    public function __construct(ProvinceRepository $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageProvinceRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageProvinceRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Province::selectRaw('provinces.*');

                return DataTables::of($query)
                    ->editColumn('province_code', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.provinces.show', $row) . '">' . $row->province_code . "</a></span>";
                    })
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('active', function ($row) {
                        return $row->active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View Province') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update Province') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete Province') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['province_code','action','active'])
                    ->make(true);
            }
        }

        return view('backend.province.index')
            ->withprovinces($this->provinceRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageProvinceRequest    $request
     *
     * @return mixed
     */
    public function create(ManageProvinceRequest $request)
    {
        return view('backend.province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProvinceRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreProvinceRequest $request)
    {
        $this->provinceRepository->create($request->all());

        // Fire create event (ProvinceCreated)
        event(new ProvinceCreated($request));

        return redirect()->route('admin.provinces.index')
            ->withFlashSuccess(__('backend_provinces.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageProvinceRequest  $request
     * @param Province               $province
     *
     * @return mixed
     */
    public function show(ManageProvinceRequest $request, Province $province)
    {
        return view('backend.province.show')->withProvince($province);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageProvinceRequest $request
     * @param Province              $province
     *
     * @return mixed
     */
    public function edit(ManageProvinceRequest $request, Province $province)
    {
        return view('backend.province.edit')->withProvince($province);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProvinceRequest  $request
     * @param Province               $province
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $this->provinceRepository->update($province, $request->all());

        // Fire update event (ProvinceUpdated)
        event(new ProvinceUpdated($request));

        return redirect()->route('admin.provinces.index')
            ->withFlashSuccess(__('backend_provinces.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageProvinceRequest $request
     * @param Province              $province
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageProvinceRequest $request, Province $province)
    {
        $this->provinceRepository->deleteById($province->id);

        // Fire delete event (ProvinceDeleted)
        event(new ProvinceDeleted($request));

        return redirect()->route('admin.provinces.deleted')
            ->withFlashSuccess(__('backend_provinces.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageProvinceRequest $request
     * @param Province              $deletedProvince
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageProvinceRequest $request, $deletedProvince)
    {
        // $this->provinceRepository->forceDelete($deletedProvince);
        $deletedProvince->forceDelete();

        return redirect()->route('admin.provinces.index')
            ->withFlashSuccess(__('backend_provinces.alerts.deleted_permanently'));
    }

    /**
     * @param ManageProvinceRequest $request
     * @param Province              $deletedProvince
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageProvinceRequest $request, Province $deletedProvince)
    {
        $this->provinceRepository->restore($deletedProvince);

        return redirect()->route('admin.provinces.index')
            ->withFlashSuccess(__('backend_provinces.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageProvinceRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageProvinceRequest $request)
    {
        return view('backend.province.deleted')
            ->withprovinces($this->provinceRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}