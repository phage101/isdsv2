@extends('backend.layouts.app')

@section('title', __('backend_categories.labels.management') . ' | ' . __('backend_categories.labels.edit'))

@section('breadcrumb-links')
    @include('backend.category.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($category, 'PATCH', route('admin.categories.update', $category->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_categories.labels.management')
                        <small class="text-muted">@lang('backend_categories.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_categories.validation.attributes.request_types_id'))->class('col-md-2 form-control-label')->for('request_types_id') }}

                        <div class="col-md-10">
                            {{ html()->select('request_types_id', $requestTypes ?? [], $category->request_types_id ?? null)->class('form-control')->required() }}
                        </div><!--col-->
                </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('backend_categories.validation.attributes.category'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('backend_categories.validation.attributes.category'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Description')->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                ->class('form-control')
                                ->placeholder('Description')
                                ->value(old('description', $category->description)) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Active')->class('col-md-2 form-control-label')->for('active') }}

                        <div class="col-md-10">
                            {{ html()->select('active', [1 => 'Yes', 0 => 'No'], old('active', $category->active ? 1 : 0))->class('form-control') }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.categories.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
