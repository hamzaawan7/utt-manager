<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TypePriceCategory
 * @package App\Models
 * @property integer price_category_id
 * @property integer type_id
 * @property integer price_seven_night
 * @property integer price_monday_to_friday
 * @property integer price_friday_to_monday
 */
class TypePriceCategory extends Model
{
    use HasFactory;

    protected $table = 'price_category_type';

    /**
     * @var string[]
     */
    protected $fillable = [
        'price_category_id',
        'type_id',
        'price_seven_night',
        'price_monday_to_friday',
        'price_friday_to_monday',
    ];
}
