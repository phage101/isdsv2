@extends('backend.layouts.app')

@section('title', __('backend_media.labels.management') . ' | ' . __('backend_media.labels.create'))

@section('breadcrumb-links')
    @include('backend.medium.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.media.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_media.labels.management')
                        <small class="text-muted">@lang('backend_media.labels.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_media.validation.attributes.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('backend_media.validation.attributes.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">@lang('backend_media.validation.attributes.active')</label>
                        <div class="col-md-10">
                            <div class="form-check">
                                <input type="checkbox" name="active" value="1" class="form-check-input" id="active" checked>
                                <label class="form-check-label" for="active">@lang('strings.yes')</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.media.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
