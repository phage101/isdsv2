<?php

return [
    'table' => [
        'request_type'    => 'Request Type',
        'name'            => 'Name',
        'active'          => 'Active',
        'created'         => 'Created',
        'actions'         => 'Actions',
        'last_updated'    => 'Updated',
        'total'           => 'Total|Totals',
        'deleted'         => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Request Type created',
        'updated' => 'Request Type updated',
        'deleted' => 'Request Type was deleted',
        'deleted_permanently' => 'Request Type was permanently deleted',
        'restored'  => 'Request Type was restored',
    ],

    'labels'    => [
        'management'    => 'Request Type Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'request_type'  => 'Request Type',
        'name'          => 'Name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'request_type' => 'Request Type',
            'name'         => 'Name',
            'active'       => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Request Type',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'request_type'    => 'Request Type',
                'name'            => 'Name',
                'active'          => 'Active',
                'created_at'      => 'Created',
                'last_updated'    => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Request Type',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
