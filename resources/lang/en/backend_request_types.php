<?php

return [
    'table' => [
        'request_type'    => 'Request Type',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New RequestType created',
        'updated' => 'RequestType updated',
        'deleted' => 'RequestType was deleted',
        'deleted_permanently' => 'RequestType was permanently deleted',
        'restored'  => 'RequestType was restored',
    ],

    'labels'    => [
        'management'    => 'RequestType Management',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'request_type'    => 'Request Type',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'request_type' => 'Request Type',
        ]
    ],

    'sidebar' => [
        'title'  => 'RequestType',
    ],

    'tabs' => [
        'request_type'    => 'Request Type',
        'content'   => [
            'overview' => [
                'request_type'    => 'Request Type',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'RequestType',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];