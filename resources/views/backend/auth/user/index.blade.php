@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.users.management') }} <small class="text-muted">{{ __('labels.backend.access.users.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.auth.user.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover" id="users-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.users.table.last_name')</th>
                            <th>@lang('labels.backend.access.users.table.first_name')</th>
                            <th>@lang('labels.backend.access.users.table.email')</th>
                            <th>@lang('labels.backend.access.users.table.confirmed')</th>
                            <th>@lang('labels.backend.access.users.table.roles')</th>
                            <!-- <th>@lang('labels.backend.access.users.table.other_permissions')</th>
                            <th>@lang('labels.backend.access.users.table.social')</th> -->
                            <th>@lang('labels.backend.access.users.table.last_updated')</th>
                            <th>@lang('labels.general.actions')</th>
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
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.auth.user.index') }}",
            columns: [
                { data: 'last_name', name: 'last_name', searchable: true },
                { data: 'first_name', name: 'first_name', searchable: true },
                { data: 'email', name: 'email', searchable: true },
                { data: 'confirmed', name: 'confirmed', searchable: false },
                { data: 'roles_label', name: 'roles_label', orderable: false, searchable: false },
                // { data: 'permissions_label', name: 'permissions_label', orderable: false, searchable: false },
                // { data: 'social', name: 'social', orderable: false, searchable: false },
                { data: 'updated_at', name: 'updated_at', searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
@endsection
