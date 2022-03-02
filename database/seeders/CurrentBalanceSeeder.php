<?php

namespace Database\Seeders;

use App\Models\CurrentBalance;
use Illuminate\Database\Seeder;

class CurrentBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrentBalance::insert([
            [
                'user_id' => '1',
                'credit_point' => '2000',
                'debit_point' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'credit_point' => '2000',
                'debit_point' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
