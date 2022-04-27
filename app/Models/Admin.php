<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, ActivityLogTrait;

    protected $guard = 'admin';
    protected $guarded = ['id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function adminLoginLogs()
    {
        return $this->hasMany(AdminLoginLog::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function google2fa()
    {
        return $this->hasOne(Google2fa::class)->latest()->where('confirmed', 1)->where('resetted', 0);
    }
}
