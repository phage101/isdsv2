<?php

Breadcrumbs::for('admin.meetings.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_meetings.labels.management'), route('admin.meetings.index'));
});

Breadcrumbs::for('admin.meetings.create', function ($trail) {
    $trail->parent('admin.meetings.index');
    $trail->push(__('backend_meetings.labels.create'), route('admin.meetings.create'));
});

Breadcrumbs::for('admin.meetings.show', function ($trail, $id) {
    $trail->parent('admin.meetings.index');
    $trail->push(__('backend_meetings.labels.view'), route('admin.meetings.show', $id));
});

Breadcrumbs::for('admin.meetings.edit', function ($trail, $id) {
    $trail->parent('admin.meetings.index');
    $trail->push(__('backend.meetings.labels.edit'), route('admin.meetings.edit', $id));
});

Breadcrumbs::for('admin.meetings.deleted', function ($trail) {
    $trail->parent('admin.meetings.index');
    $trail->push(__('backend_meetings.labels.deleted'), route('admin.meetings.deleted'));
});
