<?php

Breadcrumbs::for('admin.provinces.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_provinces.labels.management'), route('admin.provinces.index'));
});

Breadcrumbs::for('admin.provinces.create', function ($trail) {
    $trail->parent('admin.provinces.index');
    $trail->push(__('backend_provinces.labels.create'), route('admin.provinces.create'));
});

Breadcrumbs::for('admin.provinces.show', function ($trail, $id) {
    $trail->parent('admin.provinces.index');
    $trail->push(__('backend_provinces.labels.view'), route('admin.provinces.show', $id));
});

Breadcrumbs::for('admin.provinces.edit', function ($trail, $id) {
    $trail->parent('admin.provinces.index');
    $trail->push(__('backend_provinces.labels.edit'), route('admin.provinces.edit', $id));
});

Breadcrumbs::for('admin.provinces.deleted', function ($trail) {
    $trail->parent('admin.provinces.index');
    $trail->push(__('backend_provinces.labels.deleted'), route('admin.provinces.deleted'));
});
