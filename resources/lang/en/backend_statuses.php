<?php

return [
    'table' => [
        'name'            => 'Name',
        'status_type'     => 'Type',
        'status_color'    => 'Color',
        'status_hex'      => 'Hex',
        'active'          => 'Active',
        'created'         => 'Created',
        'actions'         => 'Actions',
        'last_updated'    => 'Updated',
        'total'           => 'Total|Totals',
        'deleted'         => 'Deleted',
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
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'          => 'Name',
        'status_type'   => 'Type',
        'status_color'  => 'Color',
        'status_hex'    => 'Hex',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name'           => 'Name',
            'status_type'    => 'Type',
            'status_color'   => 'Color',
            'status_hex'     => 'Hex',
            'active'         => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Status',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'name'            => 'Name',
                'status_type'     => 'Type',
                'status_color'    => 'Color',
                'status_hex'      => 'Hex',
                'active'          => 'Active',
                'created_at'      => 'Created',
                'last_updated'    => 'Updated'
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
