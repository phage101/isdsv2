@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_media.labels.management'))

@section('breadcrumb-links')
    @include('backend.medium.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_media.labels.management') }} <small class="text-muted">{{ __('backend_media.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.medium.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_media.table.name')</th>
                            <th>@lang('backend_media.table.created')</th>
                            <th>@lang('backend_media.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($media as $medium)
                            <tr>
                                <td class="align-middle"><a href="/admin/media/{{ $medium->id }}">{{ $medium->name }}</a></td>
                                <td class="align-middle">{!! $medium->created_at !!}</td>
                                <td class="align-middle">{{ $medium->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $medium->trashed_buttons !!}</td>
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
                    {!! $media->count() !!} {{ trans_choice('backend_media.table.total', $media->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $media->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
