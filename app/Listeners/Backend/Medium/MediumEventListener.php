<?php

namespace App\Listeners\Backend\Medium;

/**
 * Class MediumEventListener.
 */
class MediumEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->medium->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->medium->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->medium->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Medium\MediumCreated::class,
            'App\Listeners\Backend\Medium\MediumEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Medium\MediumUpdated::class,
            'App\Listeners\Backend\Medium\MediumEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Medium\MediumDeleted::class,
            'App\Listeners\Backend\Medium\MediumEventListener@onDeleted'
        );
    }
}
