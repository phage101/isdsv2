<?php

namespace App\Listeners\Backend\PriorityLevel;

/**
 * Class PriorityLevelEventListener.
 */
class PriorityLevelEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->priorityLevel->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->priorityLevel->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->priorityLevel->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\PriorityLevel\PriorityLevelCreated::class,
            'App\Listeners\Backend\PriorityLevel\PriorityLevelEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\PriorityLevel\PriorityLevelUpdated::class,
            'App\Listeners\Backend\PriorityLevel\PriorityLevelEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\PriorityLevel\PriorityLevelDeleted::class,
            'App\Listeners\Backend\PriorityLevel\PriorityLevelEventListener@onDeleted'
        );
    }
}
