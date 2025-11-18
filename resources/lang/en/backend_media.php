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
        'created' => 'New Medium created',
        'updated' => 'Medium updated',
        'deleted' => 'Medium was deleted',
        'deleted_permanently' => 'Medium was permanently deleted',
        'restored'  => 'Medium was restored',
    ],

    'labels'    => [
        'management'    => 'Medium Management',
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
        'title'  => 'Medium',
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
      'main' => 'Medium',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
