@extends('backend.layouts.app')

@section('title', __('backend_office_types.labels.management') . ' | ' . __('backend_office_types.labels.view'))

@section('breadcrumb-links')
    @include('backend.office_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_office_types.labels.management')
                    <small class="text-muted">@lang('backend_office_types.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="office_type">@lang('backend_office_types.tabs.content.overview.office_type')</label>

                    <div class="col-md-10">
                        {{ html()->text('office_type')->class('form-control bg-white')->disabled()->value(old('office_type', $officeType->office_type)) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_office_types.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($officeType->created_at) }} ({{ $officeType->created_at->diffForHumans() }}),
                    <strong>@lang('backend_office_types.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($officeType->updated_at) }} ({{ $officeType->updated_at->diffForHumans() }})
                    @if($officeType->trashed())
                        <strong>@lang('backend_office_types.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($officeType->deleted_at) }} ({{ $officeType->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
