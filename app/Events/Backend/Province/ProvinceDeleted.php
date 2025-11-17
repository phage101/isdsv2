<?php

namespace App\Events\Backend\Province;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProvinceDeleted.
 */
class ProvinceDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $province;

    /**
     * @param $province
     */
    public function __construct($province)
    {
        $this->province = $province;
    }
}
