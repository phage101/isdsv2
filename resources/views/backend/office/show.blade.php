@extends('backend.layouts.app')

@section('title', __('backend_offices.labels.management') . ' | ' . __('backend_offices.labels.view'))

@section('breadcrumb-links')
    @include('backend.office.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_offices.labels.management')
                    <small class="text-muted">@lang('backend_offices.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="title">@lang('backend_offices.tabs.content.overview.title')</label>

                    <div class="col-md-10">
                        {{ html()->text('title')->class('form-control bg-white')->disabled()->value(old('title', $office->title)) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label">Office Code</label>

                    <div class="col-md-10">
                        {{ html()->text('office_code')->class('form-control bg-white')->disabled()->value(old('office_code', $office->office_code ?? '')) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label">Name</label>

                    <div class="col-md-10">
                        {{ html()->text('name')->class('form-control bg-white')->disabled()->value(old('name', $office->name ?? '')) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label">Office Type</label>

                    <div class="col-md-10">
                        {{ html()->text('office_type')->class('form-control bg-white')->disabled()->value(old('office_type', optional($office->officeType)->name ?? 'N/A')) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label">Province</label>

                    <div class="col-md-10">
                        {{ html()->text('province')->class('form-control bg-white')->disabled()->value(old('province', optional($office->province)->name ?? '')) }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label">Active</label>

                    <div class="col-md-10">
                        @if(isset($office->active))
                            @if($office->active)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        @else
                            <span class="badge badge-secondary">N/A</span>
                        @endif
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_offices.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($office->created_at) }} ({{ $office->created_at->diffForHumans() }}),
                    <strong>@lang('backend_offices.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($office->updated_at) }} ({{ $office->updated_at->diffForHumans() }})
                    @if($office->trashed())
                        <strong>@lang('backend_offices.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($office->deleted_at) }} ({{ $office->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
