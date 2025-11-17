<?php

namespace App\Listeners\Backend\RequestType;

/**
 * Class RequestTypeEventListener.
 */
class RequestTypeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->requestType->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->requestType->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->requestType->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Frontend\RequestType\RequestTypeCreated::class,
            'App\Listeners\Backend\RequestType\RequestTypeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Frontend\RequestType\RequestTypeUpdated::class,
            'App\Listeners\Backend\RequestType\RequestTypeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Frontend\RequestType\RequestTypeDeleted::class,
            'App\Listeners\Backend\RequestType\RequestTypeEventListener@onDeleted'
        );
    }
}
