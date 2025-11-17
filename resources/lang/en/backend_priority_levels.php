<?php

return [
    'table' => [
        'name'    => 'name',
        'description' => 'description',
        'is_active' => 'active',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New PriorityLevel created',
        'updated' => 'PriorityLevel updated',
        'deleted' => 'PriorityLevel was deleted',
        'deleted_permanently' => 'PriorityLevel was permanently deleted',
        'restored'  => 'PriorityLevel was restored',
    ],

    'labels'    => [
        'management'    => 'PriorityLevel Management',
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
            'description' => 'description',
            'is_active' => 'active',
        ]
    ],

    'sidebar' => [
        'title'  => 'PriorityLevel',
    ],

    'tabs' => [
        'name'    => 'name',
        'content'   => [
            'overview' => [
                'name'    => 'name',
                'description' => 'description',
                'is_active' => 'active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'PriorityLevel',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];