<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepositTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('deposit_transactions')->insert([

            [
                'admin_farmer_request_id' => 3,
                'mapped_transaction_id' => 14,
                'approved_qty'=> 300,
                'amount'=> 4980,
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'updated_at' => '2022-11-08',
                'status' => 'delivered',
            ],
            [
                'admin_farmer_request_id' => 5,
                'mapped_transaction_id' => 15,
                'approved_qty'=> 200,
                'amount'=> 4614,
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at' => '2022-11-08',
                'status' => 'delivered',
            ],
            
        ]);
    }
}
