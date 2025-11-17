<?php

namespace App\Events\Frontend\SubCategory;

use Illuminate\Queue\SerializesModels;

/**
 * Class SubCategoryDeleted.
 */
class SubCategoryDeleted
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
