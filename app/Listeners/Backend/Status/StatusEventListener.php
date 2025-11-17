<?php

namespace App\Listeners\Backend\Status;

/**
 * Class StatusEventListener.
 */
class StatusEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->status->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->status->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->status->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Status\StatusCreated::class,
            'App\Listeners\Backend\Status\StatusEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Status\StatusUpdated::class,
            'App\Listeners\Backend\Status\StatusEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Status\StatusDeleted::class,
            'App\Listeners\Backend\Status\StatusEventListener@onDeleted'
        );
    }
}
