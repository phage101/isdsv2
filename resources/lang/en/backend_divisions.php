<?php

return [
    'table' => [
        'name'           => 'Name',
        'division_code'  => 'Division Code',
        'active'         => 'Active',
        'created'        => 'Created',
        'actions'        => 'Actions',
        'last_updated'   => 'Updated',
        'total'          => 'Total|Totals',
        'deleted'        => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Division created',
        'updated' => 'Division updated',
        'deleted' => 'Division was deleted',
        'deleted_permanently' => 'Division was permanently deleted',
        'restored'  => 'Division was restored',
    ],

    'labels'    => [
        'management'    => 'Division Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'          => 'Name',
        'division_code' => 'Division Code',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name'           => 'Name',
            'division_code'  => 'Division Code',
            'active'         => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Division',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'name'           => 'Name',
                'division_code'  => 'Division Code',
                'active'         => 'Active',
                'created_at'     => 'Created',
                'last_updated'   => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Division',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];