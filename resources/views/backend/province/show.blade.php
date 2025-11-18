@extends('backend.layouts.app')

@section('title', __('backend_provinces.labels.management') . ' | ' . __('backend_provinces.labels.view'))

@section('breadcrumb-links')
    @include('backend.province.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_provinces.labels.management')
                    <small class="text-muted">@lang('backend_provinces.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-info-circle"></i> @lang('backend_provinces.tabs.titles.overview')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.province.show.tabs.overview')
                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_provinces.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($province->created_at) }} ({{ $province->created_at->diffForHumans() }}),
                    <strong>@lang('backend_provinces.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($province->updated_at) }} ({{ $province->updated_at->diffForHumans() }})
                    @if($province->trashed())
                        <strong>@lang('backend_provinces.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($province->deleted_at) }} ({{ $province->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
