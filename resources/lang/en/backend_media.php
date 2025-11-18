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
        'created' => 'New Medium created',
        'updated' => 'Medium updated',
        'deleted' => 'Medium was deleted',
        'deleted_permanently' => 'Medium was permanently deleted',
        'restored'  => 'Medium was restored',
    ],

    'labels'    => [
        'management'    => 'Medium Management',
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
        'title'  => 'Medium',
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
      'main' => 'Medium',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];