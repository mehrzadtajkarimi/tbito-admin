<?php

namespace Database\Seeders;

use App\Models\Commission;
use App\Models\Currency;
use App\Models\CurrencyNetwork;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::query()->truncate();
        CurrencyNetwork::query()->truncate();
        $this->seedCurrencies();
        $this->seedCurrencyNetworks();
    }

    public function seedCurrencies()
    {
        $objects = [
            [
                'title' => 'IRT',
                'name_fa' => 'تومان',
                'name_en' => 'Toman',
                'decimals' => 0,
                'withdraw_min' => 300000,
                'withdraw_fee' => 0,
                'deposit_confirm_count' => null,
                'has_networks' => 0,
                'sort' => 1,
                'status' => 1,
                'address_regex' => null
            ],
            [
                'title' => 'USDT',
                'name_fa' => 'تتر',
                'name_en' => 'Tether',
                'decimals' => 6,
                'withdraw_min' => null,
                'withdraw_fee' => null,
                'deposit_confirm_count' => 100,
                'has_networks' => 1,
                'sort' => 2,
                'status' => 0,
                'address_regex' => null
            ],
            [
                'title' => 'BTC',
                'name_fa' => 'بیت کوین',
                'name_en' => 'Bitcoin',
                'decimals' => 6,
                'pic' => 'btc.svg',
                'withdraw_min' => 0.001,
                'withdraw_fee' => 0.0004,
                'deposit_confirm_count' => 100,
                'has_networks' => 0,
                'sort' => 3,
                'status' => 1,
                'address_regex' => '^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$'
            ],
            [
                'title' => 'ETH',
                'name_fa' => 'اتریوم',
                'name_en' => 'Ethereum',
                'decimals' => 6,
                'pic' => 'eth.svg',
                'withdraw_min' => 0.01,
                'withdraw_fee' => 0.005,
                'deposit_confirm_count' => 100,
                'has_networks' => 0,
                'sort' => 4,
                'status' => 0,
                'address_regex' => '^0x[a-fA-Z0-9]{40}$'
            ],
            [
                'title' => 'TRX',
                'name_fa' => 'ترون',
                'name_en' => 'Tron',
                'decimals' => 6,
                'pic' => 'eth.svg',
                'withdraw_min' => 2,
                'withdraw_fee' => 1,
                'deposit_confirm_count' => 100,
                'has_networks' => 0,
                'sort' => 5,
                'status' => 0,
                'address_regex' => null
            ],
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new Currency();
            $obj->id = $idCounter;
            $obj->title = $object['title'];
            $obj->name_fa = $object['name_fa'];
            $obj->name_en = $object['name_en'];
            $obj->decimals = $object['decimals'];
            $obj->withdraw_min = $object['withdraw_min'];
            $obj->withdraw_fee = $object['withdraw_fee'];
            $obj->deposit_confirm_count = $object['deposit_confirm_count'];
            $obj->has_networks = $object['has_networks'];
            $obj->address_regex = $object['address_regex'];
            $obj->sort = $object['sort'];
            $obj->status = $object['status'];
            $obj->save();
            $idCounter++;
        }
    }

    public function seedCurrencyNetworks()
    {
        $objects = [
            [
                'title' => 'erc20',
                'parent_currency_id' => 2,
                'currency_id' => 4,
                'withdraw_fee' => 3,
                'withdraw_min' => 10,
                'selected' => 1,
                'sort' => 1,
                'status' => 1,
                'address_regex' => '^0x[a-fA-Z0-9]{40}$'
            ],
            [
                'title' => 'trc20',
                'parent_currency_id' => 2,
                'currency_id' => 5,
                'withdraw_fee' => 0,
                'withdraw_min' => 1,
                'selected' => 0,
                'sort' => 2,
                'status' => 1,
                'address_regex' => null
            ],
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new CurrencyNetwork();
            $obj->id = $idCounter;
            $obj->title = $object['title'];
            $obj->parent_currency_id = $object['parent_currency_id'];
            $obj->currency_id = $object['currency_id'];
            $obj->withdraw_fee = $object['withdraw_fee'];
            $obj->withdraw_min = $object['withdraw_min'];
            $obj->address_regex = $object['address_regex'];
            $obj->selected = $object['selected'];
            $obj->sort = $object['sort'];
            $obj->status = $object['status'];
            $obj->save();
            $idCounter++;
        }
    }
}
