<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\Commission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commission::query()->truncate();
        $this->seedCommissions();
    }

    public function seedCommissions()
    {
        $objects = [
            [
                'min_monthly_total_trades_irt' => 0,
                'max_monthly_total_trades_irt' => 50000000,
                'percent' => 0.3,
            ],
            [
                'min_monthly_total_trades_irt' => 50000000,
                'max_monthly_total_trades_irt' => 100000000,
                'percent' => 0.2,
            ],
            [
                'min_monthly_total_trades_irt' => 100000000,
                'max_monthly_total_trades_irt' => null,
                'percent' => 0.1,
            ]
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new Commission();
            $obj->id = $idCounter;
            $obj->min_monthly_total_trades_irt = $object['min_monthly_total_trades_irt'];
            $obj->max_monthly_total_trades_irt = $object['max_monthly_total_trades_irt'];
            $obj->percent = $object['percent'];
            $obj->save();
            $idCounter++;
        }
    }
}
