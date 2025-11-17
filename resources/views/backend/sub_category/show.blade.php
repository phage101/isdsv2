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
                    <label class="col-md-2 form-control-label" for="sub_category">Sub Category</label>

                    <div class="col-md-10">
                        {{ html()->text('sub_category')->class('form-control bg-white')->disabled()->value(old('sub_category', $subCategory->sub_category)) }}
                    </div><!--col-->
                </div><!--form-group-->
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
