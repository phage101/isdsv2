<?php

Breadcrumbs::for('admin.priority_levels.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_priority_levels.labels.management'), route('admin.priority_levels.index'));
});

Breadcrumbs::for('admin.priority_levels.create', function ($trail) {
    $trail->parent('admin.priority_levels.index');
    $trail->push(__('backend_priority_levels.labels.create'), route('admin.priority_levels.create'));
});

Breadcrumbs::for('admin.priority_levels.show', function ($trail, $id) {
    $trail->parent('admin.priority_levels.index');
    $trail->push(__('backend_priority_levels.labels.view'), route('admin.priority_levels.show', $id));
});

Breadcrumbs::for('admin.priority_levels.edit', function ($trail, $id) {
    $trail->parent('admin.priority_levels.index');
    $trail->push(__('backend_priority_levels.labels.edit'), route('admin.priority_levels.edit', $id));
});

Breadcrumbs::for('admin.priority_levels.deleted', function ($trail) {
    $trail->parent('admin.priority_levels.index');
    $trail->push(__('backend_priority_levels.labels.deleted'), route('admin.priority_levels.deleted'));
});
