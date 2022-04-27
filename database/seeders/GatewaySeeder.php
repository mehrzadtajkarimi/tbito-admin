<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Gateway;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gateway::query()->truncate();
        $this->seedGateways();
    }

    public function seedGateways()
    {
        $objects = [
            [
                'title' => 'vandar',
                'withdraw_fee_percent' => 1,
                'max_withdraw_fee_irt' => 4000,
            ],
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new Gateway();
            $obj->title = $object['title'];
            $obj->withdraw_fee_percent = $object['withdraw_fee_percent'];
            $obj->max_withdraw_fee_irt = $object['max_withdraw_fee_irt'];
            $obj->save();
            $idCounter++;
        }
    }
}
