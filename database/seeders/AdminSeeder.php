<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\UserLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->truncate();
        $this->seedAdmins();
    }

    public function seedAdmins()
    {
        $objects = [
            [
                'name' => 'mehrzad',
                'email' => 'mehrzad@gmail.com',
                'post' => 'مدیر اجرایی',
                'password' => 123456,
                'is_super_admin' => 1
            ],
            [
                'name' => 'Trader',
                'email' => 'trader.robot@tbito.com',
                'post' => 'مدیر ارشد',
                'password' => 123456,
                'is_super_admin' => 0
            ],
            [
                'name' => 'ali',
                'email' => 'ali@gmail.com',
                'post' => 'مدیر اداری',
                'password' => 123456,
                'is_super_admin' => 0
            ],
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            Admin::create([
                'id' => $idCounter++,
                'name' => $object['name'],
                'email' => $object['email'],
                'post' => $object['post'],
                'password' => $object['password'],
                'is_super_admin' => $object['is_super_admin'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
