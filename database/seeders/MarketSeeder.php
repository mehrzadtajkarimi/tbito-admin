<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Market::query()->truncate();
        $this->seedMarkets();
    }

    public function seedMarkets()
    {
        $objects = [
            [
                'title' => 'USDT-IRT',
                'currency1_id' => 2,
                'currency2_id' => 1,
                'min_order' => 100000
            ],
            [
                'title' => 'BTC-IRT',
                'currency1_id' => 3,
                'currency2_id' => 1,
                'min_order' => 100000,
            ],
            [
                'title' => 'BTC-USDT',
                'currency1_id' => 3,
                'currency2_id' => 2,
                'min_order' => 10,
            ],
            [
                'title' => 'ETH-IRT',
                'currency1_id' => 4,
                'currency2_id' => 1,
                'min_order' => 100000,
            ],
            [
                'title' => 'ETH-USDT',
                'currency1_id' => 4,
                'currency2_id' => 2,
                'min_order' => 10,
            ],
            [
                'title' => 'TRX-IRT',
                'currency1_id' => 5,
                'currency2_id' => 1,
                'min_order' => 100000,
            ],
            [
                'title' => 'TRX-USDT',
                'currency1_id' => 5,
                'currency2_id' => 2,
                'min_order' => 10,
            ],
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new Market();
            $obj->title = $object['title'];
            $obj->currency1_id = $object['currency1_id'];
            $obj->currency2_id = $object['currency2_id'];
            $obj->min_order = $object['min_order'];
            $obj->save();
            $idCounter++;
        }
    }
}
