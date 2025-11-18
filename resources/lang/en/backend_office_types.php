<?php

return [
    'table' => [
        'office_type'    => 'Office Type',
        'name'           => 'Name',
        'active'         => 'Active',
        'created'        => 'Created',
        'actions'        => 'Actions',
        'last_updated'   => 'Updated',
        'total'          => 'Total|Totals',
        'deleted'        => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Office Type created',
        'updated' => 'Office Type updated',
        'deleted' => 'Office Type was deleted',
        'deleted_permanently' => 'Office Type was permanently deleted',
        'restored'  => 'Office Type was restored',
    ],

    'labels'    => [
        'management'    => 'Office Type Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'office_type'   => 'Office Type',
        'name'          => 'Name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'office_type' => 'Office Type',
            'name'        => 'Name',
            'active'      => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Office Type',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'office_type'   => 'Office Type',
                'name'          => 'Name',
                'active'        => 'Active',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Office Type',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];