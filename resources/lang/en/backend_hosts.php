<?php

return [
    'table' => [
        'name'          => 'Name',
        'active'        => 'Active',
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
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'          => 'Name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name'   => 'Name',
            'active' => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Host',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'name'          => 'Name',
                'active'        => 'Active',
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
