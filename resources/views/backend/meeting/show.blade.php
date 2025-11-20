@extends('backend.layouts.app')

@section('title', __('backend_meetings.labels.management') . ' | ' . __('backend_meetings.labels.view'))

@section('breadcrumb-links')
    @include('backend.meeting.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <h4 class="card-title mb-0">
                        @lang('backend_meetings.labels.management')
                        <small class="text-muted">@lang('backend_meetings.labels.view')</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-4 text-right">
                    <div class="btn-group" role="group" aria-label="{{ __('labels.backend.meetings.actions') }}">
                        <a href="{{ route('admin.meetings.edit', $meeting) }}" data-toggle="tooltip"
                            data-placement="top" title="{{ __('buttons.general.crud.edit') }}"
                            class="btn btn-primary"><i class="fas fa-edit"></i></a>

                        <a href="javascript:;" style="cursor:pointer;" onclick="$(this).find('form').submit();"
                            title="{{ __('buttons.general.crud.delete') }}" data-method="delete"
                            data-trans-button-cancel="{{ __('buttons.general.cancel') }}"
                            data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}"
                            data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="btn btn-danger">
                            <form action="{{ route('admin.meetings.delete-permanently', $meeting) }}" method="GET"
                                name="delete_item" style="display:none">
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            </form>
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('backend_meetings.tabs.content.overview.request_number'))->class('col-md-2 form-control-label')->for('request_number') }}

                        <div class="col-md-10">
                            {{ html()->text('request_number')->class('form-control bg-white')->disabled()->value(old('request_number', $meeting->request_number)) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('backend_meetings.table.requested_by'))->class('col-md-2 form-control-label')->for('requested_by') }}
                        <div class="col-md-4">
                            @php $requester = \App\Models\Auth\User::find($meeting->requested_by); @endphp
                            {{ html()->text('requested_by')->class('form-control bg-white')->disabled()->value(optional($requester)->full_name ?? '') }}
                        </div>

                        {{ html()->label(__('backend_meetings.table.date_requested'))->class('col-md-2 form-control-label')->for('date_requested') }}
                        <div class="col-md-4">
                            {{ html()->text('date_requested')->class('form-control bg-white')->disabled()->value(old('date_requested', optional($meeting)->date_requested)) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('backend_meetings.table.topic'))->class('col-md-2 form-control-label')->for('topic') }}
                        <div class="col-md-10">
                            {{ html()->text('topic')->class('form-control bg-white')->disabled()->value(old('topic', optional($meeting)->topic)) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('backend_meetings.table.date_scheduled'))->class('col-md-2 form-control-label')->for('date_scheduled') }}
                        <div class="col-md-3">
                            {{ html()->text('date_scheduled')->class('form-control bg-white')->disabled()->value(old('date_scheduled', optional($meeting)->date_scheduled)) }}
                        </div>

                        {{ html()->label(__('backend_meetings.table.time_start'))->class('col-md-2 form-control-label')->for('time_start') }}
                        <div class="col-md-2">
                            {{ html()->text('time_start')->class('form-control bg-white')->disabled()->value(old('time_start', optional($meeting)->time_start)) }}
                        </div>

                        {{ html()->label(__('backend_meetings.table.time_end'))->class('col-md-1 form-control-label')->for('time_end') }}
                        <div class="col-md-2">
                            {{ html()->text('time_end')->class('form-control bg-white')->disabled()->value(old('time_end', optional($meeting)->time_end)) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('backend_meetings.table.hosts'))->class('col-md-2 form-control-label')->for('hosts_id') }}
                        <div class="col-md-4">
                            @php $host = \App\Models\Host::find($meeting->hosts_id); @endphp
                            {{ html()->text('hosts_id')->class('form-control bg-white')->disabled()->value(optional($host)->name ?? '') }}
                        </div>

                        {{ html()->label(__('backend_meetings.table.status'))->class('col-md-2 form-control-label')->for('statuses_id') }}
                        <div class="col-md-4">
                            @php $status = \App\Models\Status::find($meeting->statuses_id); @endphp
                            {{ html()->text('statuses_id')->class('form-control bg-white')->disabled()->value(optional($status)->name ?? '') }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Details')->class('col-md-2 form-control-label')->for('meeting_details') }}
                        <div class="col-md-10">
                            {{ html()->textarea('meeting_details')->class('form-control bg-white')->disabled()->value(old('meeting_details', optional($meeting)->meeting_details)) }}
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">

                </div><!--col-->

                <div class="col-md-6">
                    <small class="float-right text-muted">
                        <strong>@lang('backend_meetings.tabs.content.overview.created_at'):</strong>
                        {{ timezone()->convertToLocal($meeting->created_at) }}
                        ({{ $meeting->created_at->diffForHumans() }}),
                        <strong>@lang('backend_meetings.tabs.content.overview.last_updated'):</strong>
                        {{ timezone()->convertToLocal($meeting->updated_at) }} ({{ $meeting->updated_at->diffForHumans() }})
                        @if($meeting->trashed())
                            <strong>@lang('backend_meetings.tabs.content.overview.deleted_at'):</strong>
                            {{ timezone()->convertToLocal($meeting->deleted_at) }} ({{ $meeting->deleted_at->diffForHumans() }})
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection