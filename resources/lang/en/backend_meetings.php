<?php

return [
    'table' => [
        'request_number'    => 'Request Number',
        'requested_by'      => 'Requested By',
        'date_requested'    => 'Date Requested',
        'topic'             => 'Topic',
        'date_scheduled'    => 'Date Scheduled',
        'time_start'        => 'Start Time',
        'time_end'          => 'End Time',
        'hosts'             => 'Host',
        'status'            => 'Status',
        'created'           => 'Created',
        'actions'           => 'Actions',
        'last_updated'      => 'Updated',
        'total'             => 'Total|Totals',
        'deleted'           => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New meeting created',
        'updated' => 'Meeting updated',
        'deleted' => 'Meeting was deleted',
        'deleted_permanently' => 'Meeting was permanently deleted',
        'restored'  => 'Meeting was restored',
    ],

    'labels'    => [
        'management'    => 'Meeting Management',
        'active'        => 'Active',
        'create'        => 'Create Meeting',
        'edit'          => 'Edit Meeting',
        'view'          => 'View Meeting',
        'request_number'    => 'Request Number',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'exceptions' => [
        'create_error' => 'There was a problem creating the meeting.',
        'update_error' => 'There was a problem updating the meeting.',
        'delete_first' => 'Meeting must be deleted first before it can be permanently removed.',
        'delete_error' => 'There was a problem deleting the meeting.',
        'restore_error' => 'There was a problem restoring the meeting.',
        'schedule_conflict' => 'The selected host has a scheduling conflict for the chosen date/time range.'
    ],

    'validation' => [
        'attributes' => [
            'request_number' => 'Request Number',
        ]
    ],

    'sidebar' => [
        'title'  => 'Meetings',
    ],

    'tabs' => [
        'request_number'    => 'Request Number',
        'content'   => [
            'overview' => [
                'request_number'    => 'Request Number',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

        'menus' => [
            'main' => 'Meetings',
            'all' => 'All Meetings',
            'create' => 'Create Meeting',
            'deleted' => 'Deleted Meetings'
        ]
];