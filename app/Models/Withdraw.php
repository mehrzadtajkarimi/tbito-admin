<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdraw extends Model
{
    use HasFactory ,ActivityLogTrait ,SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault('');
    }
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class , 'bank_account_id')->withDefault('');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class , 'currency_id')->withDefault('');
    }



}
