@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_meetings.labels.management'))

@section('breadcrumb-links')
    @include('backend.meeting.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_meetings.labels.management') }} <small class="text-muted">{{ __('backend_meetings.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.meeting.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_meetings.table.request_number')</th>
                            <th>@lang('backend_meetings.table.created')</th>
                            <th>@lang('backend_meetings.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($meetings as $meeting)
                            <tr>
                                <td class="align-middle"><a href="/admin/meetings/{{ $meeting->id }}">{{ $meeting->request_number }}</a></td>
                                <td class="align-middle">{!! $meeting->created_at !!}</td>
                                <td class="align-middle">{{ $meeting->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $meeting->trashed_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $meetings->count() !!} {{ trans_choice('backend_meetings.table.total', $meetings->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $meetings->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
