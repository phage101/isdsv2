@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_request_types.labels.management'))

@section('breadcrumb-links')
    @include('backend.request_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_request_types.labels.management') }} <small class="text-muted">{{ __('backend_request_types.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.request_type.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('backend_request_types.table.request_type') ?? 'Request Type' }}</th>
                            <th>@lang('backend_request_types.table.created')</th>
                            <th>@lang('backend_request_types.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requestTypes as $requestType)
                            <tr>
                                <td class="align-middle"><a href="/admin/request_types/{{ $requestType->id }}">{{ $requestType->request_type }}</a></td>
                                <td class="align-middle">{!! $requestType->created_at !!}</td>
                                <td class="align-middle">{{ $requestType->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $requestType->trashed_buttons !!}</td>
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
                    {!! $requestTypes->count() !!} {{ trans_choice('backend_request_types.table.total', $requestTypes->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $requestTypes->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
