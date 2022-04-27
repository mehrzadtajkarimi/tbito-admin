<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteFee extends Model
{
    use HasFactory, ActivityLogTrait; // , SoftDeletes

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id')->withDefault('');
    }
}
