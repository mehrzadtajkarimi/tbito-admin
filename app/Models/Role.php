<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Permission;
use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, SoftDeletes, ActivityLogTrait;

    protected $guarded = ['id'];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }
}
