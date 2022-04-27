<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory, ActivityLogTrait, SoftDeletes;

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
