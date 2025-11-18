<?php

return [
    'table' => [
        'sub_category'    => 'Sub Category',
        'name'            => 'Name',
        'category'        => 'Category',
        'description'     => 'Description',
        'active'          => 'Active',
        'created'         => 'Created',
        'actions'         => 'Actions',
        'last_updated'    => 'Updated',
        'total'           => 'Total|Totals',
        'deleted'         => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Sub Category created',
        'updated' => 'Sub Category updated',
        'deleted' => 'Sub Category was deleted',
        'deleted_permanently' => 'Sub Category was permanently deleted',
        'restored'  => 'Sub Category was restored',
    ],

    'labels'    => [
        'management'    => 'Sub Category Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'sub_category'  => 'Sub Category',
        'name'          => 'Name',
        'category'      => 'Category',
        'categories_id' => 'Category',
        'description'   => 'Description',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'categories_id'  => 'Category',
            'sub_category'   => 'Sub Category',
            'name'           => 'Name',
            'category'       => 'Category',
            'description'    => 'Description',
            'active'         => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Sub Category',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'sub_category'    => 'Sub Category',
                'name'            => 'Name',
                'category'        => 'Category',
                'description'     => 'Description',
                'active'          => 'Active',
                'created_at'      => 'Created',
                'last_updated'    => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Sub Category',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
