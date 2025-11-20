<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\MeetingAttribute;

class Meeting extends Model
{
    use MeetingAttribute,
        SoftDeletes;

    /**
     * Boot the model and attach creating event to auto-generate request_number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->request_number)) {
                $model->request_number = static::generateRequestNumber();
            }
        });
    }

    /**
     * Generate next request number in format MTG-YYYY-MM-XXXX
     *
     * @return string
     */
    public static function generateRequestNumber()
    {
        $prefix = 'MTG-' . date('Y') . '-' . date('m') . '-';

        // Find latest request_number for this month
        $latest = static::where('request_number', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($latest && preg_match('/(\d{4})$/', $latest->request_number, $m)) {
            $seq = intval($m[1]) + 1;
        } else {
            $seq = 1;
        }

        return $prefix . str_pad($seq, 4, '0', STR_PAD_LEFT);
    }

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
}