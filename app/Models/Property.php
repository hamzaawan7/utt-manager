<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Category;
use App\Models\Review;
use App\Models\PropertyFeature;
use App\Models\Price;
use App\Models\PriceCategory;

/**
 * Class Property
 * @package App\Models
 * @property string property_name
 * @property string short_code
 * @property string phone
 * @property integer address
 * @property integer post_code
 * @property string nearby
 * @property integer main_image
 * @property integer image_gallery
 * @property integer category_id
 */
class Property extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'property_name',
        'category_id',
        'short_code',
        'phone',
        'address',
        'post_code',
        'nearby',
        'main_image',
        'image_gallery',
    ];

    /**
     * @return HasOne
     */
    public function bookings(): HasOne
    {
        return $this->hasOne(Booking::class);
    }

    /**
     * @return HasOne
     */
    public function priceCategory(): HasOne
    {
        return $this->hasOne(PriceCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * @return HasMany
     */
    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @return HasMany
     */
    public function features(): HasMany
    {
        return $this->hasMany(PropertyFeature::class);
    }

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    /**
     * @return HasMany
     */
    public function priceCategories(): HasMany
    {
        return $this->hasMany(Price::class);
    }

}
