<?php

namespace App\Listeners\Backend\Category;

/**
 * Class CategoryEventListener.
 */
class CategoryEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = json_encode($event->category->toArray());

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = json_encode($event->category->toArray());

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = json_encode($event->category->toArray());

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Frontend\Category\CategoryCreated::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Frontend\Category\CategoryUpdated::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Frontend\Category\CategoryDeleted::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onDeleted'
        );
    }
}
