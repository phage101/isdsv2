<?php

namespace App\Listeners\Backend\Host;

/**
 * Class HostEventListener.
 */
class HostEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->host->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->host->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->host->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Host\HostCreated::class,
            'App\Listeners\Backend\Host\HostEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Host\HostUpdated::class,
            'App\Listeners\Backend\Host\HostEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Host\HostDeleted::class,
            'App\Listeners\Backend\Host\HostEventListener@onDeleted'
        );
    }
}
