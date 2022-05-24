<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feature
 * @package App\Models
 * @property string feature_name
 * @property string check_in_time
 * @property string check_out_time
 * @property string minimum_nights
 */
class Feature extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'feature_name',
        'check_in_time',
        'check_out_time',
        'minimum_nights',
    ];
    protected $casts = [
        'check_in_time' => 'date:hh:mm',
        'check_out_time' => 'date:hh:mm'
    ];
}
