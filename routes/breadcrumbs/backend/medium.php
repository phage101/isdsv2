<?php

Breadcrumbs::for('admin.media.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_media.labels.management'), route('admin.media.index'));
});

Breadcrumbs::for('admin.media.create', function ($trail) {
    $trail->parent('admin.media.index');
    $trail->push(__('backend_media.labels.create'), route('admin.media.create'));
});

Breadcrumbs::for('admin.media.show', function ($trail, $id) {
    $trail->parent('admin.media.index');
    $trail->push(__('backend_media.labels.view'), route('admin.media.show', $id));
});

Breadcrumbs::for('admin.media.edit', function ($trail, $id) {
    $trail->parent('admin.media.index');
    $trail->push(__('backend.media.labels.edit'), route('admin.media.edit', $id));
});

Breadcrumbs::for('admin.media.deleted', function ($trail) {
    $trail->parent('admin.media.index');
    $trail->push(__('backend_media.labels.deleted'), route('admin.media.deleted'));
});
