<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminLoginLog extends Model
{
    use HasFactory, ActivityLogTrait ,SoftDeletes;

    protected $guarded = ['id'];


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
