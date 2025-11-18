@extends('backend.layouts.app')

@section('title', __('backend_offices.labels.management') . ' | ' . __('backend_offices.labels.edit'))

@section('breadcrumb-links')
    @include('backend.office.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($office, 'PATCH', route('admin.offices.update', $office->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_offices.labels.management')
                        <small class="text-muted">@lang('backend_offices.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label('Office Code')->class('col-md-2 form-control-label')->for('office_code') }}

                        <div class="col-md-10">
                            {{ html()->text('office_code')
                                ->class('form-control')
                                ->placeholder('Office Code')
                                ->attribute('maxlength', 50)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Name')->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder('Office Name')
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Office Type')->class('col-md-2 form-control-label')->for('office_types_id') }}

                        <div class="col-md-10">
                            {{ html()->select('office_types_id', $officeTypes)
                                ->class('form-control')
                                ->placeholder('Select Office Type')
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Province')->class('col-md-2 form-control-label')->for('provinces_id') }}

                        <div class="col-md-10">
                            {{ html()->select('provinces_id', $provinces)
                                ->class('form-control')
                                ->placeholder('Select Province')
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                    {{ html()->label('Active')->class('col-md-2 form-control-label')->for('active') }}

                        <div class="col-md-10">
                            {{ html()->hidden('active', 0) }}
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('active', 1, old('active', $office->active))->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.offices.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
