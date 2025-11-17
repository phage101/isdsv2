@extends('backend.layouts.app')

@section('title', __('backend_sub_categories.labels.management') . ' | ' . __('backend_sub_categories.labels.create'))

@section('breadcrumb-links')
    @include('backend.sub_category.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.sub_categories.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_sub_categories.labels.management')
                        <small class="text-muted">@lang('backend_sub_categories.labels.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_sub_categories.validation.attributes.categories_id'))->class('col-md-2 form-control-label')->for('categories_id') }}

                        <div class="col-md-10">
                            {{ html()->select('categories_id', $categories ?? [], null)->class('form-control')->required() }}
                        </div><!--col-->
                </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('backend_sub_categories.validation.attributes.sub_category'))->class('col-md-2 form-control-label')->for('sub_category') }}

                        <div class="col-md-10">
                            {{ html()->text('sub_category')
                                ->class('form-control')
                                ->placeholder(__('backend_sub_categories.validation.attributes.sub_category'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.sub_categories.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
