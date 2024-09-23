<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayPalMultipleLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function paypal(): BelongsTo
    {
        return $this->belongsTo(PayPalMultiple::class, 'pay_pal_multiple_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(PayPalMultiple::class, 'user_id', 'id');
    }
}
