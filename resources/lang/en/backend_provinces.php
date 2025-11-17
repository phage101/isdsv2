<?php

return [
    'table' => [
        'province_code'    => 'province_code',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
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
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'province_code'    => 'province_code',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'province_code' => 'province_code',
        ]
    ],

    'sidebar' => [
        'title'  => 'Province',
    ],

    'tabs' => [
        'province_code'    => 'province_code',
        'content'   => [
            'overview' => [
                'province_code'    => 'province_code',
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