<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, ActivityLogTrait, SoftDeletes;

    public function market()
    {
        return $this->belongsTo(Market::class)->withDefault('');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id')->withDefault('');
    }

    public function currencyFee()
    {
        return $this->belongsTo(Currency::class, 'currency_fee_id')->withDefault('');
    }

    public function orderUser()
    {
        return $this->belongsTo(User::class, 'order_user_id')->withDefault('');
    }
}
