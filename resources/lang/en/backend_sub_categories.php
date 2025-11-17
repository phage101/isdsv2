<?php

return [
    'table' => [
        'sub_category'    => 'Sub Category',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New SubCategory created',
        'updated' => 'SubCategory updated',
        'deleted' => 'SubCategory was deleted',
        'deleted_permanently' => 'SubCategory was permanently deleted',
        'restored'  => 'SubCategory was restored',
    ],

    'labels'    => [
        'management'    => 'SubCategory Management',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'sub_category'    => 'Sub Category',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'sub_category' => 'Sub Category',
            'categories_id' => 'Category',
        ]
    ],

    'sidebar' => [
        'title'  => 'SubCategory',
    ],

    'tabs' => [
        'sub_category'    => 'Sub Category',
        'content'   => [
            'overview' => [
                'sub_category'    => 'Sub Category',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'SubCategory',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];