<?php

Breadcrumbs::for('admin.request_types.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_request_types.labels.management'), route('admin.request_types.index'));
});

Breadcrumbs::for('admin.request_types.create', function ($trail) {
    $trail->parent('admin.request_types.index');
    $trail->push(__('backend_request_types.labels.create'), route('admin.request_types.create'));
});

Breadcrumbs::for('admin.request_types.show', function ($trail, $id) {
    $trail->parent('admin.request_types.index');
    $trail->push(__('backend_request_types.labels.view'), route('admin.request_types.show', $id));
});

Breadcrumbs::for('admin.request_types.edit', function ($trail, $id) {
    $trail->parent('admin.request_types.index');
    $trail->push(__('backend.request_types.labels.edit'), route('admin.request_types.edit', $id));
});

Breadcrumbs::for('admin.request_types.deleted', function ($trail) {
    $trail->parent('admin.request_types.index');
    $trail->push(__('backend_request_types.labels.deleted'), route('admin.request_types.deleted'));
});
