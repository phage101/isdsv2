<?php

return [
    'table' => [
        'office_type'    => 'office_type',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New OfficeType created',
        'updated' => 'OfficeType updated',
        'deleted' => 'OfficeType was deleted',
        'deleted_permanently' => 'OfficeType was permanently deleted',
        'restored'  => 'OfficeType was restored',
    ],

    'labels'    => [
        'management'    => 'OfficeType Management',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'office_type'    => 'office_type',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'office_type' => 'office_type',
        ]
    ],

    'sidebar' => [
        'title'  => 'OfficeType',
    ],

    'tabs' => [
        'office_type'    => 'office_type',
        'content'   => [
            'overview' => [
                'office_type'    => 'office_type',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'OfficeType',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];