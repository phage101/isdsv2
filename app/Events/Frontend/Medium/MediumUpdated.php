<?php

namespace App\Events\Frontend\Medium;

use Illuminate\Queue\SerializesModels;

/**
 * Class MediumUpdated.
 */
class MediumUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $medium;

    /**
     * @param $medium
     */
    public function __construct($medium)
    {
        $this->medium = $medium;
    }
}
