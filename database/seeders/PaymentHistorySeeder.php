<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('payment_histories')->insert([

            // Map 1
            [
                'mapped_transaction_id'=> 1,
                'amount'=> 8287,
                'payment_method' => 'Maya',
                'reference_no' => '55390864',
                'remarks' => 'partial',
                'created_at' => '2022-05-06 11:25:59',
                'updated_at' => '2022-05-06 11:25:59',
                'status' => 'paid'
            ],
            [
                'mapped_transaction_id'=> 1,
                'amount'=> 8287,
                'payment_method' => 'Cash',
                'reference_no' => 'BXU-PRE-081722-0001',
                'remarks' => 'final',
                'created_at' => '2022-08-16',
                'updated_at' => '2022-08-16',
                'status' => 'paid'
            ],

            // Map 2
            [
                'mapped_transaction_id'=> 2,
                'amount'=> 25704,
                'payment_method' => 'Cash',
                'reference_no' => 'BXU-PRE-121922-0002',
                'remarks' => 'full',
                'created_at' => '2022-11-04 11:28:07',
                'updated_at' => '2022-11-04 11:28:07',
                'status' => 'paid'
            ],
        ]);
    }
}
