@extends('backend.layouts.app')

@section('title', __('backend_sub_categories.labels.management') . ' | ' . __('backend_sub_categories.labels.edit'))

@section('breadcrumb-links')
    @include('backend.sub_category.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($subCategory, 'PATCH', route('admin.sub_categories.update', $subCategory->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_sub_categories.labels.management')
                        <small class="text-muted">@lang('backend_sub_categories.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_sub_categories.validation.attributes.categories_id'))->class('col-md-2 form-control-label')->for('categories_id') }}

                        <div class="col-md-10">
                            {{ html()->select('categories_id', $categories ?? [], $subCategory->categories_id ?? null)->class('form-control')->required() }}
                        </div><!--col-->
                </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('backend_sub_categories.validation.attributes.sub_category'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('backend_sub_categories.validation.attributes.sub_category'))
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
                                ->value(old('description', $subCategory->description)) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label('Active')->class('col-md-2 form-control-label')->for('active') }}

                        <div class="col-md-10">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('active', old('active', $subCategory->active ?? true))->class('switch-input') }}
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
                    {{ form_cancel(route('admin.sub_categories.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
