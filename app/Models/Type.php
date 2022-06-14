<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;
use App\Models\PriceCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Type
 * @package App\Models
 * @property string type
 */
class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    /**
     * @var string[]
     */
    protected $fillable = [
        'type',
    ];

    /**
     * @return BelongsToMany
     */
    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PriceCategory::class,'price_category_type');
    }
}
