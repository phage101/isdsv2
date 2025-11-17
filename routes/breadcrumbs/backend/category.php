<?php

Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_categories.labels.management'), route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push(__('backend_categories.labels.create'), route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.show', function ($trail, $id) {
    $trail->parent('admin.categories.index');
    $trail->push(__('backend_categories.labels.view'), route('admin.categories.show', $id));
});

Breadcrumbs::for('admin.categories.edit', function ($trail, $id) {
    $trail->parent('admin.categories.index');
    $trail->push(__('backend.categories.labels.edit'), route('admin.categories.edit', $id));
});

Breadcrumbs::for('admin.categories.deleted', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push(__('backend_categories.labels.deleted'), route('admin.categories.deleted'));
});
