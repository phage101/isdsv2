@extends('backend.layouts.app')

@section('title', __('backend_statuses.labels.management') . ' | ' . __('backend_statuses.labels.view'))

@section('breadcrumb-links')
    @include('backend.status.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_statuses.labels.management')
                    <small class="text-muted">@lang('backend_statuses.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="name">@lang('backend_statuses.tabs.content.overview.name')</label>

                    <div class="col-md-10">
                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value(old('name', $status->name)) }}
                    </div><!--col-->
                </div><!--form-group-->
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="status_type">@lang('backend_statuses.tabs.content.overview.status_type')</label>

                    <div class="col-md-10">
                        <div class="form-control bg-white">{{ ucfirst($status->status_type) }}</div>
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="status_color">@lang('backend_statuses.tabs.content.overview.status_color')</label>

                    <div class="col-md-10">
                        <div class="form-control bg-white">{{ $status->status_color }}</div>
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="status_hex">@lang('backend_statuses.tabs.content.overview.status_hex')</label>

                    <div class="col-md-10">
                        <div class="form-control bg-white"><span style="display:inline-block;width:18px;height:18px;background:{{ $status->status_hex }};margin-right:8px;border:1px solid #ccc;"></span>{{ $status->status_hex }}</div>
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    <label class="col-md-2 form-control-label">@lang('backend_statuses.tabs.content.overview.is_active')</label>

                    <div class="col-md-10">
                        <div class="form-control bg-white">@if($status->is_active) @lang('strings.yes') @else @lang('strings.no') @endif</div>
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_statuses.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($status->created_at) }} ({{ $status->created_at->diffForHumans() }}),
                    <strong>@lang('backend_statuses.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($status->updated_at) }} ({{ $status->updated_at->diffForHumans() }})
                    @if($status->trashed())
                        <strong>@lang('backend_statuses.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($status->deleted_at) }} ({{ $status->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
