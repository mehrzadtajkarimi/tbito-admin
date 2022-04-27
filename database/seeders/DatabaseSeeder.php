<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            BankAccountSeeder::class,
            CommissionSeeder::class,
            CurrencySeeder::class,
            GatewaySeeder::class,
            LocationSeeder::class,
            MarketSeeder::class,
            PermissionSeeder::class,
            SiteContentSeeder::class,
            SiteSettingSeeder::class,
            UserLevelSeeder::class,
            UserSeeder::class
        ]);
    }
}
