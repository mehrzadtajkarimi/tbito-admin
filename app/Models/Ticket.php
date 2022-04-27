<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory ,ActivityLogTrait ,SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault('');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault('');
    }

    public function children()
    {
        return $this->hasMany(Ticket::class, 'parent_id');    
    }
}
