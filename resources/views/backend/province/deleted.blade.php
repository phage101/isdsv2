@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_provinces.labels.management'))

@section('breadcrumb-links')
    @include('backend.province.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_provinces.labels.management') }} <small class="text-muted">{{ __('backend_provinces.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.province.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_provinces.table.province_code')</th>
                            <th>@lang('backend_provinces.table.created')</th>
                            <th>@lang('backend_provinces.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($provinces as $province)
                            <tr>
                                <td class="align-middle"><a href="/admin/provinces/{{ $province->id }}">{{ $province->province_code }}</a></td>
                                <td class="align-middle">{!! $province->created_at !!}</td>
                                <td class="align-middle">{{ $province->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $province->trashed_buttons !!}</td>
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
                    {!! $provinces->count() !!} {{ trans_choice('backend_provinces.table.total', $provinces->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $provinces->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
