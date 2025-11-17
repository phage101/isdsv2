<?php

namespace App\Events\Frontend\Province;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProvinceUpdated.
 */
class ProvinceUpdated
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
