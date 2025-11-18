<?php

return [
    'table' => [
        'name'            => 'Name',
        'description'     => 'Description',
        'active'          => 'Active',
        'created'         => 'Created',
        'actions'         => 'Actions',
        'last_updated'    => 'Updated',
        'total'           => 'Total|Totals',
        'deleted'         => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Priority Level created',
        'updated' => 'Priority Level updated',
        'deleted' => 'Priority Level was deleted',
        'deleted_permanently' => 'Priority Level was permanently deleted',
        'restored'  => 'Priority Level was restored',
    ],

    'labels'    => [
        'management'    => 'Priority Level Management',
        'active'        => 'Active',
        'inactive'      => 'Inactive',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'          => 'Name',
        'description'   => 'Description',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name'        => 'Name',
            'description' => 'Description',
            'active'      => 'Active',
        ]
    ],

    'sidebar' => [
        'title'  => 'Priority Level',
    ],

    'tabs' => [
        'titles' => [
            'overview' => 'Overview',
        ],
        'content'   => [
            'overview' => [
                'name'            => 'Name',
                'description'     => 'Description',
                'active'          => 'Active',
                'created_at'      => 'Created',
                'last_updated'    => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Priority Level',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
