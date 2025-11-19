@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.roles.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.roles.management')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.role.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover" id="roles-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.roles.table.role')</th>
                            <th>@lang('labels.backend.access.roles.table.permissions')</th>
                            <th style="width:25%; text-align: left;">@lang('labels.backend.access.roles.table.number_of_users')</th>
                            <th style="width:10%">@lang('labels.general.actions')</th>
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

@push('after-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css">
@endpush

@push('after-scripts')
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
<script>
    $(function() {
        $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.auth.role.index') }}",
            columns: [
                { data: 'name', name: 'name', searchable: true },
                { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
                { data: 'users_count', name: 'users_count', searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
@endsection
