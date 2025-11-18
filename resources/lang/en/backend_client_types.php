<?php

return [
    'table' => [
        'name'    => 'name',
        'description' => 'Description',
        'active' => 'Active',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New ClientType created',
        'updated' => 'ClientType updated',
        'deleted' => 'ClientType was deleted',
        'deleted_permanently' => 'ClientType was permanently deleted',
        'restored'  => 'ClientType was restored',
    ],

    'labels'    => [
        'management'    => 'ClientType Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'    => 'name',
        'description' => 'Description',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name' => 'name',
            'description' => 'description',
            'active' => 'active',
        ]
    ],

    'sidebar' => [
        'title'  => 'ClientType',
    ],

    'tabs' => [
        'name'    => 'name',
        'content'   => [
            'overview' => [
                'name'    => 'name',
                'description' => 'Description',
                'active' => 'Active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'ClientType',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];