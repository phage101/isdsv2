<?php

return [
    'table' => [
        'name'    => 'name',
        'active' => 'active',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Host created',
        'updated' => 'Host updated',
        'deleted' => 'Host was deleted',
        'deleted_permanently' => 'Host was permanently deleted',
        'restored'  => 'Host was restored',
    ],

    'labels'    => [
        'management'    => 'Host Management',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'    => 'name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name' => 'name',
            'active' => 'active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Host',
    ],

    'tabs' => [
        'name'    => 'name',
        'content'   => [
            'overview' => [
                'name'    => 'name',
                'active' => 'active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Host',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];