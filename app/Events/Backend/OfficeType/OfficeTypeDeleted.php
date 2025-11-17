<?php

namespace App\Events\Backend\OfficeType;

use Illuminate\Queue\SerializesModels;

/**
 * Class OfficeTypeDeleted.
 */
class OfficeTypeDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $officeType;

    /**
     * @param $officeType
     */
    public function __construct($officeType)
    {
        $this->officeType = $officeType;
    }
}
