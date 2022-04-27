<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, ActivityLogTrait, SoftDeletes;

    public function market()
    {
        return $this->belongsTo(Market::class)->withDefault('');
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault('');
    }

    public function currency1()
    {
        return $this->belongsTo(Currency::class, 'currency1_id')->withDefault('');
    }
    public function currency2()
    {
        return $this->belongsTo(Currency::class, 'currency2_id')->withDefault('');
    }
    public function currencyFee()
    {
        return $this->belongsTo(Currency::class, 'currency_fee_id')->withDefault('');
    }
}
