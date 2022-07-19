<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Property;

/**
 * Class Review
 * @package App\Models
 * @property string review_id
 * @property string comment
 * @property string star_rating
 * @property string is_accept
 * @property string is_show
 */
class Review extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'review_id',
        'comment',
        'star_rating',
        'is_accept',
        'is_show',
        ];

    /**
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
