@extends('backend.layouts.app')

@section('title', __('backend_request_types.labels.management') . ' | ' . __('backend_request_types.labels.view'))

@section('breadcrumb-links')
    @include('backend.request_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_request_types.labels.management')
                    <small class="text-muted">@lang('backend_request_types.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="request_type">Request Type</label>

                    <div class="col-md-10">
                        {{ html()->text('request_type')->class('form-control bg-white')->disabled()->value(old('request_type', $requestType->request_type)) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_request_types.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($requestType->created_at) }} ({{ $requestType->created_at->diffForHumans() }}),
                    <strong>@lang('backend_request_types.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($requestType->updated_at) }} ({{ $requestType->updated_at->diffForHumans() }})
                    @if($requestType->trashed())
                        <strong>@lang('backend_request_types.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($requestType->deleted_at) }} ({{ $requestType->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
