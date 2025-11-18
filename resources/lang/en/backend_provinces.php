<?php

return [
    'table' => [
        'province_code'    => 'Province Code',
        'name'             => 'Name',
        'active'           => 'Active',
        'created'          => 'Created',
        'actions'          => 'Actions',
        'last_updated'     => 'Updated',
        'total'            => 'Total|Totals',
        'deleted'          => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Province created',
        'updated' => 'Province updated',
        'deleted' => 'Province was deleted',
        'deleted_permanently' => 'Province was permanently deleted',
        'restored'  => 'Province was restored',
    ],

    'labels'    => [
        'management'    => 'Province Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'province_code' => 'Province Code',
        'name'          => 'Name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'province_code' => 'Province Code',
            'name'          => 'Name',
            'active'        => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Province',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'province_code' => 'Province Code',
                'name'          => 'Name',
                'active'        => 'Active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Province',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];