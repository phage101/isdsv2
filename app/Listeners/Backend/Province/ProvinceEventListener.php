<?php

namespace App\Listeners\Backend\Province;

/**
 * Class ProvinceEventListener.
 */
class ProvinceEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->province->province_code;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->province->province_code;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->province->province_code;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Province\ProvinceCreated::class,
            'App\Listeners\Backend\Province\ProvinceEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Province\ProvinceUpdated::class,
            'App\Listeners\Backend\Province\ProvinceEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Province\ProvinceDeleted::class,
            'App\Listeners\Backend\Province\ProvinceEventListener@onDeleted'
        );
    }
}
