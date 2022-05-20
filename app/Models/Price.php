<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Property;

/**
 * Class Price
 * @package App\Models
 * @property integer property_id
 * @property integer category_id
 * @property integer season_id
 * @property string range
 * @property string price
 */
class Price extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'property_id',
        'category_id',
        'season_id',
        'range',
        'price',
    ];

    /**
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
