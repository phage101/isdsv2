@extends('backend.layouts.app')

@section('title', __('backend_statuses.labels.management') . ' | ' . __('backend_statuses.labels.edit'))

@section('breadcrumb-links')
    @include('backend.status.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($status, 'PATCH', route('admin.statuses.update', $status->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_statuses.labels.management')
                        <small class="text-muted">@lang('backend_statuses.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_statuses.validation.attributes.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('backend_statuses.validation.attributes.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('backend_statuses.validation.attributes.status_type'))->class('col-md-2 form-control-label')->for('status_type') }}

                        <div class="col-md-10">
                            {{ html()->select('status_type', ['helpdesk' => 'Helpdesk', 'meeting' => 'Meeting'], old('status_type', $status->status_type))->class('form-control') }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('backend_statuses.validation.attributes.status_color'))->class('col-md-2 form-control-label')->for('status_color') }}

                        <div class="col-md-10">
                            {{ html()->text('status_color')
                                ->class('form-control')
                                ->placeholder(__('backend_statuses.validation.attributes.status_color'))
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('backend_statuses.validation.attributes.status_hex'))->class('col-md-2 form-control-label')->for('status_hex') }}

                        <div class="col-md-10">
                            <input type="color" name="status_hex" value="{{ old('status_hex', $status->status_hex ?? '#ffffff') }}" class="form-control" style="height:40px;padding:2px;">
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('backend_statuses.validation.attributes.active'))->class('col-md-2 form-control-label')->for('active') }}

                        <div class="col-md-10">
                            {{ html()->hidden('active', 0) }}
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('active', 1, old('active', $status->active))->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.statuses.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
