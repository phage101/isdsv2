<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\OfficeAttribute;

class Office extends Model
{
    use OfficeAttribute,
        SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the office type for this office.
     */
    public function officeType()
    {
        return $this->belongsTo(OfficeType::class, 'office_types_id');
    }

    /**
     * Get the province for this office.
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'provinces_id');
    }
}