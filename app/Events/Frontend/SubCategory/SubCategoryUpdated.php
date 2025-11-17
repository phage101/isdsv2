<?php

namespace App\Events\Frontend\SubCategory;

use Illuminate\Queue\SerializesModels;

/**
 * Class SubCategoryUpdated.
 */
class SubCategoryUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $subCategory;

    /**
     * @param $subCategory
     */
    public function __construct($subCategory)
    {
        $this->subCategory = $subCategory;
    }
}
