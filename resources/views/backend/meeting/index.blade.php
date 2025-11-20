@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_meetings.labels.management'))

@section('breadcrumb-links')
    @include('backend.meeting.includes.breadcrumb-links')
@endsection
@push('after-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css">
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_meetings.labels.management') }} <small class="text-muted">{{ __('backend_meetings.labels.active') }}</small>
                </h4>
            </div><!--col-->
            @if (auth()->user()->can('Store '))
                <div class="col-sm-7">
                    @include('backend.meeting.includes.header-buttons')
                    <div class="btn-group ml-2" role="group" aria-label="View Toggle">
                        <button id="view-calendar" class="btn btn-outline-secondary btn-sm active">Calendar</button>
                        <button id="view-grid" class="btn btn-outline-secondary btn-sm">Grid</button>
                    </div>
                </div><!--col-->
            @endif
        </div><!--row-->
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <div id="calendar"></div>

                    <div id="grid" style="display:none; margin-top:10px;">
                        <table id="meetings-table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('backend_meetings.table.request_number')</th>
                                    <th>@lang('backend_meetings.table.requested_by')</th>
                                    <th>@lang('backend_meetings.table.date_requested')</th>
                                    <th>@lang('backend_meetings.table.topic')</th>
                                    <th>@lang('backend_meetings.table.date_scheduled')</th>
                                    <th>@lang('backend_meetings.table.time_start')</th>
                                    <th>@lang('backend_meetings.table.time_end')</th>
                                    <th>@lang('backend_meetings.table.hosts')</th>
                                    <th>@lang('backend_meetings.table.status')</th>
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
@push('after-scripts')
<!-- FullCalendar resources (CDN) -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            navLinks: true,
            selectable: false,
            nowIndicator: true,
            events: {
                url: '{{ route('admin.meetings.events') }}',
                method: 'GET',
            },
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault();
                }
            },
            eventDidMount: function(info) {
                // show host/requester in tooltip
                var host = info.event.extendedProps.host || '';
                var requestedBy = info.event.extendedProps.requested_by || '';
                var tooltip = '';
                if (host) tooltip += 'Host: ' + host + '\n';
                if (requestedBy) tooltip += 'Requested by: ' + requestedBy;
                if (tooltip) {
                    info.el.setAttribute('title', tooltip);
                }
            }
        });

        var dataTable = null;
        var calendarRendered = false;

        function renderCalendar() {
            if (!calendarRendered) {
                calendar.render();
                calendarRendered = true;
            }
            document.getElementById('calendar').style.display = '';
            document.getElementById('grid').style.display = 'none';
        }

        function renderGrid() {
            document.getElementById('calendar').style.display = 'none';
            document.getElementById('grid').style.display = '';

            if ($.fn.DataTable && dataTable === null) {
                dataTable = $('#meetings-table').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ajax: "{{ route('admin.meetings.index') }}",
                    columns: [
                        { data: 'request_number', name: 'request_number', searchable: true },
                        { data: 'requested_by', name: 'requested_by', searchable: true },
                        { data: 'date_requested', name: 'date_requested', searchable: false },
                        { data: 'topic', name: 'topic', searchable: true },
                        { data: 'date_scheduled', name: 'date_scheduled', searchable: false },
                        { data: 'time_start', name: 'time_start', searchable: false },
                        { data: 'time_end', name: 'time_end', searchable: false },
                        { data: 'hosts', name: 'hosts', searchable: false },
                        { data: 'status', name: 'status', searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            } else if (dataTable) {
                dataTable.ajax.reload();
            }
        }

        // Toggle handlers
        $('#view-calendar').on('click', function() {
            $('#view-grid').removeClass('active');
            $(this).addClass('active');
            renderCalendar();
        });

        $('#view-grid').on('click', function() {
            $('#view-calendar').removeClass('active');
            $(this).addClass('active');
            renderGrid();
        });

        // initial render
        renderCalendar();
    });
</script>
@endpush
@push('after-scripts')
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
@endpush