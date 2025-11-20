<?php

namespace App\Listeners\Backend\Meeting;

/**
 * Class MeetingEventListener.
 */
class MeetingEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->meeting->request_number;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->meeting->request_number;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->meeting->request_number;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Meeting\MeetingCreated::class,
            'App\Listeners\Backend\Meeting\MeetingEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Meeting\MeetingUpdated::class,
            'App\Listeners\Backend\Meeting\MeetingEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Meeting\MeetingDeleted::class,
            'App\Listeners\Backend\Meeting\MeetingEventListener@onDeleted'
        );
    }
}
