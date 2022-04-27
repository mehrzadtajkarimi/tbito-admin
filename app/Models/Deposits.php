<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposits extends Model
{
    use HasFactory, ActivityLogTrait ,SoftDeletes;

    public function getTxidLinkAttribute()
    {
        if ($this->currency_id == 2) {
            $link = "https://blockchair.com/ethereum/transaction/{$this->txid}";
        } elseif ($this->currency_id == 3) {
            $link = "https://blockchair.com/bitcoin/transaction/{$this->txid}";
        } elseif ($this->currency_id == 4) {
            $link = "https://blockchair.com/ethereum/transaction/{$this->txid}";
        }
        return $link;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault('');
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id')->withDefault('');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id')->withDefault('');
    }
}
