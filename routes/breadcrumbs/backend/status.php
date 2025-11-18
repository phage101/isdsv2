<?php

Breadcrumbs::for('admin.statuses.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_statuses.labels.management'), route('admin.statuses.index'));
});

Breadcrumbs::for('admin.statuses.create', function ($trail) {
    $trail->parent('admin.statuses.index');
    $trail->push(__('backend_statuses.labels.create'), route('admin.statuses.create'));
});

Breadcrumbs::for('admin.statuses.show', function ($trail, $id) {
    $trail->parent('admin.statuses.index');
    $trail->push(__('backend_statuses.labels.view'), route('admin.statuses.show', $id));
});

Breadcrumbs::for('admin.statuses.edit', function ($trail, $id) {
    $trail->parent('admin.statuses.index');
    $trail->push(__('backend_statuses.labels.edit'), route('admin.statuses.edit', $id));
});

Breadcrumbs::for('admin.statuses.deleted', function ($trail) {
    $trail->parent('admin.statuses.index');
    $trail->push(__('backend_statuses.labels.deleted'), route('admin.statuses.deleted'));
});
