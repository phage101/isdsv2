@extends('backend.layouts.app')

@section('title', __('backend_meetings.labels.management') . ' | ' . __('backend_meetings.labels.edit'))

@section('breadcrumb-links')
    @include('backend.meeting.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->modelForm($meeting, 'PATCH', route('admin.meetings.update', $meeting->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_meetings.labels.management')
                        <small class="text-muted">@lang('backend_meetings.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    {{-- Select options are provided by controller: $users, $hosts, $statuses --}}

                    <div class="form-group row">
                        {{ html()->label(__('backend_meetings.validation.attributes.request_number'))->class('col-md-2 form-control-label')->for('request_number') }}

                        <div class="col-md-10">
                            {{ html()->text('request_number')
        ->class('form-control')
        ->placeholder(__('backend_meetings.validation.attributes.request_number'))
        ->attribute('maxlength', 191)
        ->attribute('disabled', 'disabled')
        ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row mt-3">
                        {{ html()->label('Requested By')->class('col-md-2 form-control-label')->for('requested_by') }}
                        <div class="col-md-4">
                            {{ html()->select('requested_by', $users, null)->class('form-control select2')->attribute('style', 'width:100%') }}
                        </div>

                        {{ html()->label('Date Requested')->class('col-md-2 form-control-label')->for('date_requested') }}
                        <div class="col-md-4">
                            {{ html()->date('date_requested')->class('form-control') }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Topic')->class('col-md-2 form-control-label')->for('topic') }}
                        <div class="col-md-10">
                            {{ html()->text('topic')->class('form-control')->required() }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Date Scheduled')->class('col-md-2 form-control-label')->for('date_scheduled') }}
                        <div class="col-md-3">
                            {{ html()->date('date_scheduled')->class('form-control') }}
                        </div>

                        {{ html()->label('Start Time')->class('col-md-2 form-control-label')->for('time_start') }}
                        <div class="col-md-2">
                            {{ html()->time('time_start')->class('form-control') }}
                        </div>

                        {{ html()->label('End Time')->class('col-md-1 form-control-label')->for('time_end') }}
                        <div class="col-md-2">
                            {{ html()->time('time_end')->class('form-control') }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        {{ html()->label('Host')->class('col-md-2 form-control-label')->for('hosts_id') }}
                        <div class="col-md-4">
                            {{ html()->select('hosts_id', $hosts, null)->class('form-control') }}
                        </div>

                        {{ html()->label('Status')->class('col-md-2 form-control-label')->for('statuses_id') }}
                        <div class="col-md-4">
                            {{ html()->select('statuses_id', $statuses, null)->class('form-control') }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Details')->class('col-md-2 form-control-label')->for('meeting_details') }}
                        <div class="col-md-10">
                            {{ html()->textarea('meeting_details')->class('form-control')->attribute('rows', 4) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="send_email" name="send_email">
                                <label class="form-check-label" for="send_email">
                                    {{ __('Send email to requester') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.meetings.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection

@push('after-scripts')
    <script>
        (function ($) {
            $(function () {
                // Initialize Select2 for requester
                if ($.fn.select2) {
                    $('select[name="requested_by"]').select2({
                        placeholder: '{{ addslashes(__('Select requester')) }}',
                        width: '100%'
                    });
                }
            });
        })(jQuery);
    </script>
@endpush

@push('after-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush