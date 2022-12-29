<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CommitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('commits')->insert([
            //ampalaya
            [
                'user_id'=> 2,
                'qty'=> 300,
                'commited_farm_size'=> 7058.82,
                'status' => 'pending',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 7,
                'created_at'=> \Carbon\Carbon::now()->subDays(3),
            ],
            [
                'user_id'=> 3,
                'qty'=> 300,
                'commited_farm_size'=> 7058.82,
                'status' => 'pending',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 7,
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
            ],
            [
                'user_id'=> 6,
                'qty'=> 300,
                'commited_farm_size'=> 7058.82,
                'status' => 'pending',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 7,
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
            ],
            //eggplant
            [
                'user_id'=> 9,
                'qty'=> 300,
                'commited_farm_size'=> 3281.06,
                'status' => 'approved',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 8,
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
            ],
            [
                'user_id'=> 16,
                'qty'=> 300,
                'commited_farm_size'=> 3281.06,
                'status' => 'approved',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 8,
                'created_at'=> \Carbon\Carbon::now(),
            ],
            [
                'user_id'=> 8,
                'qty'=> 400,
                'commited_farm_size'=> 4374.74,
                'status' => 'approved',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 8,
                'created_at'=> \Carbon\Carbon::now(),
            ],
            //cauliflower
            [
                'user_id'=> 2,
                'qty'=> 400,
                'commited_farm_size'=> 1250.2,
                'status' => 'pending',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 9,
                'created_at'=> \Carbon\Carbon::now()->subDays(6),
                
            ],
            [
                'user_id'=> 3,
                'qty'=> 1100,
                'commited_farm_size'=> 3438.04,
                'status' => 'pending',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 9,
                'created_at'=> \Carbon\Carbon::now()->subDays(5),
                
            ],
            [
                'user_id'=> 6,
                'qty'=> 1000,
                'commited_farm_size'=> 3125.49,
                'status' => 'pending',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 9,
                'created_at'=> \Carbon\Carbon::now()->subDays(4),
                
            ],
            [
                'user_id'=> 6,
                'qty'=> 100,
                'commited_farm_size'=> 312.55,
                'status' => 'pending',
                'excess_qty' => '0',
                'consolidated_demand_id'=> 9,
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                
            ],
            
        ]);
    }
}
