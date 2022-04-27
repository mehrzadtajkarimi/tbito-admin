<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankAccount::query()->truncate();
        $this->seedBankAccounts();
    }

    public function seedBankAccounts()
    {
        $objects = [
            [
                'user_id' => 1,
                'card_num' => '5022291052532718',
                'iban_num' => '870570027280012624492101',
                'verified' => 1,
            ]
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new BankAccount();
            $obj->id = $idCounter;
            $obj->user_id = $object['user_id'];
            $obj->card_num = $object['card_num'];
            $obj->iban_num = $object['iban_num'];
            $obj->verified = $object['verified'];
            $obj->save();
            $idCounter++;
        }
    }
}
