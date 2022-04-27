<?php

namespace App\Models;

use App\Traits\ActivityLogTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, ActivityLogTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class);
    }

    public function loginLog()
    {
        return $this->hasOne(LoginLog::class)->latest();
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class, 'user_id');
    }
    // return $q->where('verified', 1);
    public function verifiedBankAccounts()
    {
        return $this->bankAccounts()->verified();
    }
    // return $q->where('verified', 0);
    public function unverifiedBankAccounts()
    {
        return $this->bankAccounts()->unverified();
    }
    // return $q->where('verified', 2);
    public function waitingBankAccounts()
    {
        return $this->bankAccounts()->verifiedWaiting();
    }
    // return $q->where('verified', 2);
    public function lastWaitingBankAccount()
    {
        return $this->hasOne(BankAccount::class, 'user_id')->verifiedWaiting()->latest();
    }
    // return $q->where('verified', 0);
    public function lastUnverifiedBankAccount()
    {
        return $this->hasOne(BankAccount::class, 'user_id')->unverified()->latest();
    }

    public function lastBankAccount()
    {
        return $this->hasOne(BankAccount::class, 'user_id')->latest();
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id')->withDefault('');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault('');
    }

    public function referralCode()
    {
        return $this->belongsTo(ReferralCode::class, 'referral_code_id')->withDefault('');
    }

    public function referralUser()
    {
        return $this->belongsTo(User::class, 'referral_user_id')->withDefault('');
    }

    public function getFullnameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }


    public function children()
    {
        return $this->hasMany(Ticket::class, 'parent_id');    
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault('');
    }









    public function getVerificationStatus($flag)
    {
        $output = [
            'color' => '',
            'icon' => '',
            'icon2' => '',
        ];

        if ($flag === 1) {
            $output['color'] = "success";
            $output['icon'] = "check-circle";
            $output['icon2'] = "check";
        } elseif ($flag === 0) {
            $output['color'] = "danger";
            $output['icon'] = "times-circle";
            $output['icon2'] = "times";
        } elseif ($flag === 2) {
            $output['color'] = "info";
            $output['icon'] = "question-circle";
            $output['icon2'] = "question";
        } else {
            $output['color'] = "secondary";
            $output['icon'] = "circle";
            $output['icon2'] = "circle invisible";
        }

        return $output;
    }

    public function getBankAccountStatus()
    {
        $output = [
            'color' => '',
            'icon' => '',
            'icon2' => '',
        ];
        if ($this->verifiedBankAccounts->isNotEmpty()) {
            $output['color'] = "success";
            $output['icon'] = "check-circle";
            $output['icon2'] = "check";
        } else {
            if ($this->waitingBankAccounts->isNotEmpty()) {
                $output['color'] = "info";
                $output['icon'] = "question-circle";
                $output['icon2'] = "question";
            } elseif ($this->unverifiedBankAccounts->isNotEmpty()) {
                $output['color'] = "danger";
                $output['icon'] = "times-circle";
                $output['icon2'] = "times";
            } else {
                $output['color'] = "secondary";
                $output['icon'] = "circle";
                $output['icon2'] = "circle invisible";
            }
        }

        return $output;
    }
    public function getWaitingBankAccountStatus()
    {
        $output = [
            'color' => '',
            'icon' => '',
            'icon2' => '',
        ];
        if ($this->waitingBankAccounts->isNotEmpty()) {
            $output['color'] = "info";
            $output['icon'] = "question-circle";
            $output['icon2'] = "question";
        } else {
            if ($this->verifiedBankAccounts->isNotEmpty()) {
                $output['color'] = "success";
                $output['icon'] = "check-circle";
                $output['icon2'] = "check";
            } elseif ($this->unverifiedBankAccounts->isNotEmpty()) {
                $output['color'] = "danger";
                $output['icon'] = "times-circle";
                $output['icon2'] = "times";
            }
        }

        return $output;
    }

    public function getPhoneStatus()
    {
        $output = [
            'color' => '',
            'icon' => '',
            'icon2' => '',
        ];
        if ($this->phone) {
            if ($this->phone_verified_at) {
                $output['color'] = "success";
                $output['icon'] = "check-circle";
                $output['icon2'] = "check";
            } else {
                $output['color'] = "info";
                $output['icon'] = "question-circle";
                $output['icon2'] = "question";
            }
        } else {
            $output['color'] = "secondary";
            $output['icon'] = "circle";
            $output['icon2'] = "circle invisible";
        }

        return $output;
    }
}
