<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

require __DIR__.'/province.php';
require __DIR__.'/office_type.php';
require __DIR__.'/office.php';
require __DIR__.'/request_type.php';
require __DIR__.'/category.php';
require __DIR__.'/sub_category.php';
require __DIR__.'/priority_level.php';
require __DIR__.'/status.php';
require __DIR__.'/medium.php';
require __DIR__.'/host.php';
require __DIR__.'/division.php';
require __DIR__.'/client_type.php';