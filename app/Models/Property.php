<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class Property
 * @package App\Models
 * @property string name
 * @property string short_code
 * @property string phone
 * @property string address
 * @property string post_code
 * @property string special_category
 * @property string utt_star_rating
 * @property integer is_visible
 */
class Property extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'owner_id',
        'name',
        'short_code',
        'phone',
        'address',
        'post_code',
        'special_category',
        'utt_star_rating',
        'is_visible',
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasMany
     */
    public function starRatings(): HasMany
    {
        return $this->hasMany(StarRating::class);
    }

    /**
     * @return BelongsToMany
     */
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    /**
     * @return HasMany
     */
    public function nearbyProperties(): HasMany
    {
        return $this->hasMany(NearbyProperty::class);
    }

    /**
     * @return HasMany
     */
    public function owners(): HasMany
    {
        return $this->hasMany(OwnerProperty::class);
    }

    /**
     * @return mixed
     */
    public function discounts(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class);
    }

    /**
     * @return HasManyThrough
     */
    public function cleaningRotas(): HasManyThrough
    {
        return $this->hasManyThrough(CleaningRota::class,Booking::class, );
    }

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
