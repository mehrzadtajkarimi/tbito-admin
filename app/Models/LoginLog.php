<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginLog extends Model
{
    use HasFactory, ActivityLogTrait , SoftDeletes;

    public function user()
    {
        return $this->belongsTo(user::class)->withDefault('');
    }
}
