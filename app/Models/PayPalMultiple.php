<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayPalMultiple extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function links(): HasMany
    {
        return $this->hasMany(PayPalMultipleLink::class, 'pay_pal_multiple_id', 'id');
    }
}
