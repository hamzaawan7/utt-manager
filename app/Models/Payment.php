<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

/**
 * Class Booking
 * @package App\Models
 * @property string total_price
 * @property string voucher_value_used
 * @property string deposit_amount
 * @property integer total_balance_paid
 * @property integer remaining_balance_paid
 * @property string balance_due_date
 * @property integer booking_id
 * @property integer discount_id
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'total_price',
        'voucher_value_used',
        'deposit_amount',
        'total_balance_paid',
        'remaining_balance_paid',
        'balance_due_date',
        'booking_id',
        'discount_id',
    ];

    /**
     * @return mixed
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
