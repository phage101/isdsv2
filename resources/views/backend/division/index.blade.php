@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_divisions.labels.management'))

@section('breadcrumb-links')
    @include('backend.division.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_divisions.labels.management') }} <small class="text-muted">{{ __('backend_divisions.labels.active') }}</small>
                </h4>
            </div><!--col-->
            @if (auth()->user()->can('Store '))
                <div class="col-sm-7">
                    @include('backend.division.includes.header-buttons')
                </div><!--col-->
            @endif
        </div><!--row-->
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="divisions_table" class="table">
                        <thead>
                            <tr>
                                <th>@lang('backend_divisions.table.division_code')</th>
                                <th>@lang('backend_divisions.table.name')</th>
                                <th style="width:0%;white-space:nowrap">Active</th>
                                <th style="width:0%;white-space:nowrap">@lang('backend_divisions.table.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css">
@endpush

@push('after-scripts')
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
<script>
    $(function() {
        $('#divisions_table').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            ajax: "{{ route('admin.divisions.index') }}",
            columns: [
                { data: 'division_code', name: 'division_code', searchable: true },
                { data: 'name', name: 'name', searchable: true },
                { data: 'active', name: 'active', searchable: false },
                { data: 'action', name: 'action', searchable: false, orderable: false }
            ]
        });
    });
</script>
@endpush