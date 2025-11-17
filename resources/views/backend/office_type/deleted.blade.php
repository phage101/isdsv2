@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_office_types.labels.management'))

@section('breadcrumb-links')
    @include('backend.office_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_office_types.labels.management') }} <small class="text-muted">{{ __('backend_office_types.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.office_type.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_office_types.table.office_type')</th>
                            <th>@lang('backend_office_types.table.created')</th>
                            <th>@lang('backend_office_types.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($officeTypes as $officeType)
                            <tr>
                                <td class="align-middle"><a href="/admin/office_types/{{ $officeType->id }}">{{ $officeType->office_type }}</a></td>
                                <td class="align-middle">{!! $officeType->created_at !!}</td>
                                <td class="align-middle">{{ $officeType->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $officeType->trashed_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $officeTypes->count() !!} {{ trans_choice('backend_office_types.table.total', $officeTypes->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $officeTypes->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
