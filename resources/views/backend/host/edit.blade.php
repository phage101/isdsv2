@extends('backend.layouts.app')

@section('title', __('backend_hosts.labels.management') . ' | ' . __('backend_hosts.labels.edit'))

@section('breadcrumb-links')
    @include('backend.host.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($host, 'PATCH', route('admin.hosts.update', $host->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_hosts.labels.management')
                        <small class="text-muted">@lang('backend_hosts.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_hosts.validation.attributes.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('backend_hosts.validation.attributes.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_hosts.validation.attributes.active'))->class('col-md-2 form-control-label')->for('active') }}

                        <div class="col-md-10">
                            {{ html()->hidden('active', 0) }}
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('active', 1, old('active', $host->active))->class('switch-input') }}
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
                    {{ form_cancel(route('admin.hosts.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
