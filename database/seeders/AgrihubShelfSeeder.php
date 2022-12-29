<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AgrihubShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('agrihub_shelves')->insert([

            [
                'deposit_transaction_id' => 1,
                'shelf_life_id' => 2,
                'qty'=> 300,
                'remaining_qty' => 300,
                'date_acquired'=> \Carbon\Carbon::now()->subDays(1),
                'salable_until' => \Carbon\Carbon::now()->addDays(3)
            ],
            [
                'deposit_transaction_id' => 2,
                'shelf_life_id' => 1,
                'qty'=> 200,
                'remaining_qty' => 200,
                'date_acquired'=> \Carbon\Carbon::now(),
                'salable_until' =>  \Carbon\Carbon::now()->addDays(3)
            ],
            
        ]);
    }
}
