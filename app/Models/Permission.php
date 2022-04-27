<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
