<?php

return [
    'table' => [
        'name'    => 'name',
        'status_type' => 'type',
        'status_color' => 'color',
        'status_hex' => 'hex',
        'is_active' => 'active',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Status created',
        'updated' => 'Status updated',
        'deleted' => 'Status was deleted',
        'deleted_permanently' => 'Status was permanently deleted',
        'restored'  => 'Status was restored',
    ],

    'labels'    => [
        'management'    => 'Status Management',
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
            'status_type' => 'type',
            'status_color' => 'color',
            'status_hex' => 'hex',
            'is_active' => 'active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Status',
    ],

    'tabs' => [
        'name'    => 'name',
        'content'   => [
            'overview' => [
                'name'    => 'name',
                'status_type' => 'type',
                'status_color' => 'color',
                'status_hex' => 'hex',
                'is_active' => 'active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Status',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];