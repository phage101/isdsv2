@extends('backend.layouts.app')

@section('title', __('backend_priority_levels.labels.management') . ' | ' . __('backend_priority_levels.labels.view'))

@section('breadcrumb-links')
    @include('backend.priority_level.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_priority_levels.labels.management')
                    <small class="text-muted">@lang('backend_priority_levels.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="name">@lang('backend_priority_levels.tabs.content.overview.name')</label>

                    <div class="col-md-10">
                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value(old('name', $priorityLevel->name)) }}
                    </div><!--col-->
                </div><!--form-group-->
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="description">@lang('backend_priority_levels.tabs.content.overview.description')</label>

                    <div class="col-md-10">
                        {{ html()->textarea('description')->class('form-control bg-white')->disabled()->value(old('description', $priorityLevel->description)) }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    <label class="col-md-2 form-control-label">@lang('backend_priority_levels.tabs.content.overview.is_active')</label>

                    <div class="col-md-10">
                        <div class="form-control bg-white">@if($priorityLevel->is_active) @lang('strings.yes') @else @lang('strings.no') @endif</div>
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_priority_levels.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($priorityLevel->created_at) }} ({{ $priorityLevel->created_at->diffForHumans() }}),
                    <strong>@lang('backend_priority_levels.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($priorityLevel->updated_at) }} ({{ $priorityLevel->updated_at->diffForHumans() }})
                    @if($priorityLevel->trashed())
                        <strong>@lang('backend_priority_levels.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($priorityLevel->deleted_at) }} ({{ $priorityLevel->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
