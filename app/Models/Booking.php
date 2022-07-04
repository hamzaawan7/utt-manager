<?php

namespace App\Models;

use App\Models\User;
use App\Models\Property;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Booking
 * @package App\Models
 * @property string number
 * @property string from_date
 * @property string to_date
 * @property integer number_of_guest
 * @property integer number_of_night
 * @property string status
 * @property integer number_of_adults
 * @property integer number_of_children
 * @property integer number_of_pets
 * @property integer number_of_infants
 * @property string note
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'property_id',
        'number',
        'from_date',
        'to_date',
        'number_of_guest',
        'number_of_night',
        'status',
        'number_of_adults',
        'number_of_children',
        'number_of_pets',
        'number_of_infants',
        'note',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function payments(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
