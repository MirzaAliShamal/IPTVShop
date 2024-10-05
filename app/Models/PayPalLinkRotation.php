<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayPalLinkRotation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'last_used_index' => 'integer',
    ];

    public function payPalMultiple(): BelongsTo
    {
        return $this->belongsTo(PayPalMultiple::class, 'pay_pal_multiple_id');
    }
}
