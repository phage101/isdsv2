@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_statuses.labels.management'))

@section('breadcrumb-links')
    @include('backend.status.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_statuses.labels.management') }} <small class="text-muted">{{ __('backend_statuses.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.status.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_statuses.table.name')</th>
                            <th>@lang('backend_statuses.table.created')</th>
                            <th>@lang('backend_statuses.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <td class="align-middle"><a href="/admin/statuses/{{ $status->id }}">{{ $status->name }}</a></td>
                                <td class="align-middle">{!! $status->created_at !!}</td>
                                <td class="align-middle">{{ $status->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $status->trashed_buttons !!}</td>
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
                    {!! $statuses->count() !!} {{ trans_choice('backend_statuses.table.total', $statuses->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $statuses->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
