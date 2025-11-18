@extends('backend.layouts.app')

@section('title', __('backend_sub_categories.labels.management') . ' | ' . __('backend_sub_categories.labels.view'))

@section('breadcrumb-links')
    @include('backend.sub_category.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_sub_categories.labels.management')
                    <small class="text-muted">@lang('backend_sub_categories.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="categories_id">Category</label>
                    <div class="col-md-10">
                        {{ html()->text('category')->class('form-control bg-white')->disabled()->value(old('category', optional(\App\Models\Category::find($subCategory->categories_id))->name)) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="name">Sub Category</label>
                    <div class="col-md-10">
                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value(old('name', $subCategory->name)) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="description">Description</label>
                    <div class="col-md-10">
                        {{ html()->textarea('description')->class('form-control bg-white')->disabled()->value(old('description', $subCategory->description)) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="active">Active</label>
                    <div class="col-md-10">
                        {{ html()->text('active')->class('form-control bg-white')->disabled()->value($subCategory->active ? 'Yes' : 'No') }}
                    </div>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_sub_categories.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($subCategory->created_at) }} ({{ $subCategory->created_at->diffForHumans() }}),
                    <strong>@lang('backend_sub_categories.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($subCategory->updated_at) }} ({{ $subCategory->updated_at->diffForHumans() }})
                    @if($subCategory->trashed())
                        <strong>@lang('backend_sub_categories.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($subCategory->deleted_at) }} ({{ $subCategory->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
