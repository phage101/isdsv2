<?php

namespace App\Listeners\Backend\OfficeType;

/**
 * Class OfficeTypeEventListener.
 */
class OfficeTypeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->office_type->office_type;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->office_type->office_type;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->office_type->office_type;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\OfficeType\OfficeTypeCreated::class,
            'App\Listeners\Backend\OfficeType\OfficeTypeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\OfficeType\OfficeTypeUpdated::class,
            'App\Listeners\Backend\OfficeType\OfficeTypeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\OfficeType\OfficeTypeDeleted::class,
            'App\Listeners\Backend\OfficeType\OfficeTypeEventListener@onDeleted'
        );
    }
}
