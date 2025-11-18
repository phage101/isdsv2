@extends('backend.layouts.app')

@section('title', __('backend_request_types.labels.management') . ' | ' . __('backend_request_types.labels.edit'))

@section('breadcrumb-links')
    @include('backend.request_type.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($requestType, 'PATCH', route('admin.request_types.update', $requestType->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_request_types.labels.management')
                        <small class="text-muted">@lang('backend_request_types.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_request_types.validation.attributes.request_type'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('backend_request_types.validation.attributes.request_type'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Acronym')->class('col-md-2 form-control-label')->for('acronym') }}

                        <div class="col-md-10">
                            {{ html()->text('acronym')
                                ->class('form-control')
                                ->placeholder('Acronym')
                                ->attribute('maxlength', 50)
                                ->value(old('acronym', $requestType->acronym)) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Description')->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                ->class('form-control')
                                ->placeholder('Description')
                                ->value(old('description', $requestType->description)) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Sort Order')->class('col-md-2 form-control-label')->for('sort_order') }}

                        <div class="col-md-10">
                            {{ html()->number('sort_order')
                                ->class('form-control')
                                ->placeholder('Sort Order')
                                ->value(old('sort_order', $requestType->sort_order)) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Active')->class('col-md-2 form-control-label')->for('active') }}

                        <div class="col-md-10">
                            {{ html()->select('active', [1 => 'Yes', 0 => 'No'], old('active', $requestType->active ? 1 : 0))->class('form-control') }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.request_types.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
