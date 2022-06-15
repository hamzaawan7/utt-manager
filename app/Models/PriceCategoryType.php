<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PriceCategoryType
 * @package App\Models
 * @property integer price_category_id
 * @property integer type_id
 * @property integer price_seven_night
 * @property integer price_monday_to_friday
 * @property integer price_friday_to_monday
 * @property integer price_standing_charge
 * @property integer price_sunday_to_thursday
 * @property integer price_friday_to_saturday
 * @property integer weekend_friday_to_monday
 */
class PriceCategoryType extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'price_category_id',
        'type_id',
        'price_seven_night',
        'price_monday_to_friday',
        'price_friday_to_monday',
        'price_standing_charge',
        'price_sunday_to_thursday',
        'price_friday_to_saturday',
        'weekend_friday_to_monday',
    ];

    /**
     * @var string
     */
    protected $table = 'price_category_type';
}
