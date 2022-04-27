<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();
        $this->seedUsers();
    }

    public function seedUsers()
    {
        $objects = [
            [
                'firstname' => 'Trader',
                'lastname' => 'Robot',
                'email' => 'trader.robot@tbito.com',
                'email_verified_at' => now(),
                'email_editing' => false,
                'mobile' => '09121112233',
                'mobile_verified_at' => now(),
                'mobile_editing' => false,
                'password' => '123',
                'user_level_id' => 3,
            ],

            [
                'firstname' => 'مهرداد',
                'lastname' => 'غریب دوست',
                'email' => 'gharibdoost.mehrdad@gmail.com',
                'email_verified_at' => now(),
                'email_editing' => false,
                'mobile' => '09128083719',
                'mobile_verified_at' => now(),
                'mobile_editing' => false,
                'password' => '123',
                'user_level_id' => 2,
            ],

            [
                'firstname' => 'سروش',
                'lastname' => 'جولای',
                'email' => 'soroushjuly@gmail.com',
                'email_verified_at' => now(),
                'email_editing' => false,
                'mobile' => '09128142487',
                'mobile_verified_at' => now(),
                'mobile_editing' => false,
                'password' => '1234',
                'user_level_id' => 1,
            ],
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new User();
            $obj->id = $idCounter;
            $obj->firstname = $object['firstname'];
            $obj->lastname = $object['lastname'];
            $obj->email = $object['email'];
            $obj->email_verified_at = $object['email_verified_at'];
            $obj->email_editing = $object['email_editing'];
            $obj->mobile = $object['mobile'];
            $obj->mobile_verified_at = $object['mobile_verified_at'];
            $obj->mobile_editing = $object['mobile_editing'];
            $obj->password = $object['password'];
            $obj->user_level_id = $object['user_level_id'];
            $obj->save();
            $idCounter++;
        }
    }
}
