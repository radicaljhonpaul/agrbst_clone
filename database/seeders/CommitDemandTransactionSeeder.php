<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommitDemandTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('commit_demand_transactions')->insert([
            
            //eggplant
            [
                'commit_id'=> 4,
                'demand_id'=> 12,
                'amount_receivable'=> 6921,
                'approved_qty'=> 300,
                'mapped_transaction_id'=> 16,
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
            ],
            [
                'commit_id'=> 5,
                'demand_id'=> 13,
                'amount_receivable'=> 6921,
                'approved_qty'=> 300,
                'mapped_transaction_id'=> 17,
                'created_at'=> \Carbon\Carbon::now(),
            ],
            [
                'commit_id'=> 6,
                'demand_id'=> 14,
                'amount_receivable'=> 9228,
                'approved_qty'=> 400,
                'mapped_transaction_id'=> 18,
                'created_at'=> \Carbon\Carbon::now(),
            ],
        ]);
    }
}
