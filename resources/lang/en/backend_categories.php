<?php

return [
    'table' => [
        'category'    => 'Category',
        'name'        => 'Name',
        'active'      => 'Active',
        'created'     => 'Created',
        'actions'     => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Category created',
        'updated' => 'Category updated',
        'deleted' => 'Category was deleted',
        'deleted_permanently' => 'Category was permanently deleted',
        'restored'  => 'Category was restored',
    ],

    'labels'    => [
        'management'    => 'Category Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'category'      => 'Category',
        'name'          => 'Name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'category' => 'Category',
            'name'     => 'Name',
            'active'   => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Category',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'category'      => 'Category',
                'name'          => 'Name',
                'active'        => 'Active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Category',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
