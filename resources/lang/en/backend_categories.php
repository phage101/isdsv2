<?php

return [
    'table' => [
        'category'    => 'Category',
        'created'       => 'Created',
        'actions'       => 'Actions',
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
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'category'    => 'Category',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'category' => 'Category',
        ]
    ],

    'sidebar' => [
        'title'  => 'Category',
    ],

    'tabs' => [
        'category'    => 'Category',
        'content'   => [
            'overview' => [
                'category'    => 'Category',
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