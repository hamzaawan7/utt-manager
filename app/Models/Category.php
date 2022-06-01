<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Property;

/**
 * Class Category
 * @package App\Models
 * @property string category_name
 * @property string standard_guests
 * @property string minimum_guest
 * @property string room_layout
 * @property string childs
 * @property string infants
 * @property string pets
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'standard_guests',
        'minimum_guest',
        'room_layout',
        'childs',
        'infants',
        'pets',
    ];

    /**
     * @return mixed
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
