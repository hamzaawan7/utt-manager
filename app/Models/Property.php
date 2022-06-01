<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Category;
use App\Models\Feature;
use App\Models\PropertyImage;
use App\Models\NearbyProperty;

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
     * @return mixed
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return mixed
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    /**
     * @return mixed
     */
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    /**
     * @return mixed
     */
    public function nearbyProperties()
    {
        return $this->hasMany(NearbyProperty::class);
    }
}
