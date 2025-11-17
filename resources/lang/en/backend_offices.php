<?php

return [
    'table' => [
        'title'    => 'Office Code',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Office created',
        'updated' => 'Office updated',
        'deleted' => 'Office was deleted',
        'deleted_permanently' => 'Office was permanently deleted',
        'restored'  => 'Office was restored',
    ],

    'labels'    => [
        'management'    => 'Office Management',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'title'    => 'Office Code',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'title' => 'Office Code',
        ]
    ],

    'sidebar' => [
        'title'  => 'Office',
    ],

    'tabs' => [
        'title'    => 'Office Code',
        'content'   => [
            'overview' => [
                'title'    => 'Office Code',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Office',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];