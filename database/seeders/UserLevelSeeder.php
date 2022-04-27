<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\UserLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLevel::query()->truncate();
        $this->seedUserLevels();
    }

    public function seedUserLevels()
    {
        $objects = [
            [
                'key' => 'new',
                'title' => 'ثبت نام اولیه',
                'requirements' => 'کاملا محدود - امکان هیچ گونه معامله ای ندارد',
                'max_daily_deposit_crypto' => 0,
                'max_daily_withdraw_crypto' => 0,
                'max_daily_deposit_irt' => 0,
                'max_daily_withdraw_irt' => 0
            ],
            [
                'key' => 'silver',
                'title' => 'نقره ای',
                'requirements' => 'ایمیل - موبایل - کارت ملی - اطلاعات بانکی',
                'max_daily_deposit_crypto' => null,
                'max_daily_withdraw_crypto' => null,
                'max_daily_deposit_irt' => 1000000,
                'max_daily_withdraw_irt' => 30000000
            ],
            [
                'key' => 'gold',
                'title' => 'طلایی',
                'requirements' => 'تکمیل اطلاعات - تلفن ثابت - سلفی',
                'max_daily_deposit_crypto' => null,
                'max_daily_withdraw_crypto' => null,
                'max_daily_deposit_irt' => null,
                'max_daily_withdraw_irt' => 200000000
            ]
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new UserLevel();
            $obj->id = $idCounter;
            $obj->key = $object['key'];
            $obj->title = $object['title'];
            $obj->requirements = $object['requirements'];
            $obj->max_daily_deposit_crypto = $object['max_daily_deposit_crypto'];
            $obj->max_daily_withdraw_crypto = $object['max_daily_withdraw_crypto'];
            $obj->max_daily_deposit_irt = $object['max_daily_deposit_irt'];
            $obj->max_daily_withdraw_irt = $object['max_daily_withdraw_irt'];
            $obj->save();
            $idCounter++;
        }
    }
}
