@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_statuses.labels.management'))

@section('breadcrumb-links')
    @include('backend.status.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_statuses.labels.management') }} <small class="text-muted">{{ __('backend_statuses.labels.active') }}</small>
                </h4>
            </div><!--col-->
            @if (auth()->user()->can('Store '))
                <div class="col-sm-7">
                    @include('backend.status.includes.header-buttons')
                </div><!--col-->
            @endif
        </div><!--row-->
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="statuses_table" class="table">
                        <thead>
                            <tr>
                                <th>@lang('backend_statuses.table.name')</th>
                                <th>@lang('backend_statuses.table.status_type')</th>
                                <th>@lang('backend_statuses.table.status_color')</th>
                                <th>@lang('backend_statuses.table.status_hex')</th>
                                <th style="width:0%;white-space:nowrap">@lang('backend_statuses.table.active')</th>
                                <th style="width:0%;white-space:nowrap">@lang('backend_statuses.table.actions')</th>
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
        $('#statuses_table').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            ajax: "{{ route('admin.statuses.index') }}",
            columns: [
                { data: 'name', name: 'name', searchable: true },
                { data: 'status_type', name: 'status_type', searchable: false },
                { data: 'status_color', name: 'status_color', searchable: false },
                { data: 'status_hex', name: 'status_hex', searchable: false },
                { data: 'active', name: 'active', searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush