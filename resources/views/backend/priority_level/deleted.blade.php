@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_priority_levels.labels.management'))

@section('breadcrumb-links')
    @include('backend.priority_level.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_priority_levels.labels.management') }} <small class="text-muted">{{ __('backend_priority_levels.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.priority_level.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_priority_levels.table.name')</th>
                            <th>@lang('backend_priority_levels.table.created')</th>
                            <th>@lang('backend_priority_levels.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($priorityLevels as $priorityLevel)
                            <tr>
                                <td class="align-middle"><a href="/admin/priority_levels/{{ $priorityLevel->id }}">{{ $priorityLevel->name }}</a></td>
                                <td class="align-middle">{!! $priorityLevel->created_at !!}</td>
                                <td class="align-middle">{{ $priorityLevel->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $priorityLevel->trashed_buttons !!}</td>
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
                    {!! $priorityLevels->count() !!} {{ trans_choice('backend_priority_levels.table.total', $priorityLevels->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $priorityLevels->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
