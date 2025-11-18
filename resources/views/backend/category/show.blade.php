@extends('backend.layouts.app')

@section('title', __('backend_categories.labels.management') . ' | ' . __('backend_categories.labels.view'))

@section('breadcrumb-links')
    @include('backend.category.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_categories.labels.management')
                    <small class="text-muted">@lang('backend_categories.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="request_types_id">Request Type</label>
                    <div class="col-md-10">
                        {{ html()->text('request_type')->class('form-control bg-white')->disabled()->value(old('request_type', optional(\App\Models\RequestType::find($category->request_types_id))->name)) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="name">Category</label>
                    <div class="col-md-10">
                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value(old('name', $category->name)) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="description">Description</label>
                    <div class="col-md-10">
                        {{ html()->textarea('description')->class('form-control bg-white')->disabled()->value(old('description', $category->description)) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="active">Active</label>
                    <div class="col-md-10">
                        @if(isset($category->active))
                            @if($category->active)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        @else
                            <span class="badge badge-secondary">N/A</span>
                        @endif
                    </div>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_categories.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($category->created_at) }} ({{ $category->created_at->diffForHumans() }}),
                    <strong>@lang('backend_categories.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($category->updated_at) }} ({{ $category->updated_at->diffForHumans() }})
                    @if($category->trashed())
                        <strong>@lang('backend_categories.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($category->deleted_at) }} ({{ $category->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
