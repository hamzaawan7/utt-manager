<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyImage extends Model
{
    use HasFactory;


    /**
     * @return belongTo
     */
    public function properties():belongTo
    {
        return $this->belongsTo(Property::class);
    }
}
