<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends Model
{
    use HasFactory, ActivityLogTrait , SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault('');
    }

    public function scopeVerified($q)
    {
        return $q->where('verified', 1);
    }

    public function scopeUnverified($q)
    {
        return $q->where('verified', 0);
    }

    public function scopeVerifiedWaiting($q)
    {
        return $q->where('verified', 2);
    }

    public function scopeVerifiedUnknown($q)
    {
        return $q->whereNull('verified');
    }
}
