<?php

Breadcrumbs::for('admin.hosts.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_hosts.labels.management'), route('admin.hosts.index'));
});

Breadcrumbs::for('admin.hosts.create', function ($trail) {
    $trail->parent('admin.hosts.index');
    $trail->push(__('backend_hosts.labels.create'), route('admin.hosts.create'));
});

Breadcrumbs::for('admin.hosts.show', function ($trail, $id) {
    $trail->parent('admin.hosts.index');
    $trail->push(__('backend_hosts.labels.view'), route('admin.hosts.show', $id));
});

Breadcrumbs::for('admin.hosts.edit', function ($trail, $id) {
    $trail->parent('admin.hosts.index');
    $trail->push(__('backend_hosts.labels.edit'), route('admin.hosts.edit', $id));
});

Breadcrumbs::for('admin.hosts.deleted', function ($trail) {
    $trail->parent('admin.hosts.index');
    $trail->push(__('backend_hosts.labels.deleted'), route('admin.hosts.deleted'));
});
