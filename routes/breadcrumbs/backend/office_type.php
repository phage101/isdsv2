<?php

Breadcrumbs::for('admin.office_types.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_office_types.labels.management'), route('admin.office_types.index'));
});

Breadcrumbs::for('admin.office_types.create', function ($trail) {
    $trail->parent('admin.office_types.index');
    $trail->push(__('backend_office_types.labels.create'), route('admin.office_types.create'));
});

Breadcrumbs::for('admin.office_types.show', function ($trail, $id) {
    $trail->parent('admin.office_types.index');
    $trail->push(__('backend_office_types.labels.view'), route('admin.office_types.show', $id));
});

Breadcrumbs::for('admin.office_types.edit', function ($trail, $id) {
    $trail->parent('admin.office_types.index');
    $trail->push(__('backend_office_types.labels.edit'), route('admin.office_types.edit', $id));
});

Breadcrumbs::for('admin.office_types.deleted', function ($trail) {
    $trail->parent('admin.office_types.index');
    $trail->push(__('backend_office_types.labels.deleted'), route('admin.office_types.deleted'));
});
