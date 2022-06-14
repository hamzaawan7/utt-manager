<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class PriceCategory
 * @package App\Models
 * @property integer category_name
 */
class PriceCategory extends Model
{
    use HasFactory;

    protected $table = 'price_categories';

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_name',
    ];

    /**
     * @return BelongsToMany
     */
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class,'price_category_type');
    }
}
