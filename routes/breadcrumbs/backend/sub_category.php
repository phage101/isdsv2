<?php

Breadcrumbs::for('admin.sub_categories.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_sub_categories.labels.management'), route('admin.sub_categories.index'));
});

Breadcrumbs::for('admin.sub_categories.create', function ($trail) {
    $trail->parent('admin.sub_categories.index');
    $trail->push(__('backend_sub_categories.labels.create'), route('admin.sub_categories.create'));
});

Breadcrumbs::for('admin.sub_categories.show', function ($trail, $id) {
    $trail->parent('admin.sub_categories.index');
    $trail->push(__('backend_sub_categories.labels.view'), route('admin.sub_categories.show', $id));
});

Breadcrumbs::for('admin.sub_categories.edit', function ($trail, $id) {
    $trail->parent('admin.sub_categories.index');
    $trail->push(__('backend.sub_categories.labels.edit'), route('admin.sub_categories.edit', $id));
});

Breadcrumbs::for('admin.sub_categories.deleted', function ($trail) {
    $trail->parent('admin.sub_categories.index');
    $trail->push(__('backend_sub_categories.labels.deleted'), route('admin.sub_categories.deleted'));
});
