<?php

namespace App\Events\Frontend\Province;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProvinceCreated.
 */
class ProvinceCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $provinces;

    /**
     * @param $provinces
     */
    public function __construct($provinces)
    {
        $this->provinces = $provinces;
    }
}
