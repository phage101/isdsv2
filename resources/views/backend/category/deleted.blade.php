@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_categories.labels.management'))

@section('breadcrumb-links')
    @include('backend.category.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_categories.labels.management') }} <small class="text-muted">{{ __('backend_categories.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.category.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('backend_categories.table.category') ?? 'Category' }}</th>
                            <th>@lang('backend_categories.table.created')</th>
                            <th>@lang('backend_categories.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="align-middle"><a href="/admin/categories/{{ $category->id }}">{{ $category->category }}</a></td>
                                <td class="align-middle">{!! $category->created_at !!}</td>
                                <td class="align-middle">{{ $category->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $category->trashed_buttons !!}</td>
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
                    {!! $categories->count() !!} {{ trans_choice('backend_categories.table.total', $categories->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $categories->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
