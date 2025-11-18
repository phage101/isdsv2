<?php

return [
    'table' => [
        'name'          => 'Name',
        'description'   => 'Description',
        'active'        => 'Active',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Client Type created',
        'updated' => 'Client Type updated',
        'deleted' => 'Client Type was deleted',
        'deleted_permanently' => 'Client Type was permanently deleted',
        'restored'  => 'Client Type was restored',
    ],

    'labels'    => [
        'management'    => 'Client Type Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'          => 'Name',
        'description'   => 'Description',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name'        => 'Name',
            'description' => 'Description',
            'active'      => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Client Type',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'name'          => 'Name',
                'description'   => 'Description',
                'active'        => 'Active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Client Type',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
