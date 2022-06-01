<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

/**
 * Class Owner
 * @package App\Models
 * @property string address
 * @property string main_contact_name
 * @property string main_contact_number
 * @property string secondary_contact_name
 * @property string secondary_contact_number
 * @property string emergency_contact_name
 * @property string emergency_contact_number
 */
class Owner extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'address',
        'main_contact_name',
        'main_contact_number',
        'secondary_contact_name',
        'secondary_contact_number',
        'emergency_contact_name',
        'emergency_contact_number',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
