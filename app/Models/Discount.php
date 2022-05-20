<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Property;

/**
 * Class Property
 * @package App\Models
 * @property string discount_period
 * @property string discount_value
 * @property string notice
 * @property string code
 * @property string code_type
 * @property string from_date
 * @property string to_date
 * @property integer reason_for_creating
 * @property integer property_id
 */
class Discount extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'discount_period',
        'property_id',
        'discount_value',
        'notice',
        'code',
        'code_type',
        'from_date',
        'to_date',
        'reason_for_creating',
    ];

    /**
     * @return HasMany
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
