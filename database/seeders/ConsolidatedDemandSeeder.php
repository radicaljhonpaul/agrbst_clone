<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsolidatedDemandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('consolidated_demands')->insert([

            [
                // eggplant for \Carbon\Carbon::now()->addDays(115) 
                // done
                'price_id'=> 2,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0001',
                'consolidated_qty' => 400,
                'consolidated_amount' => 14184,
                'date'=> \Carbon\Carbon::now()->addDays(115),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
            ],
            [
                // tomato for \Carbon\Carbon::now()->addDays(103)
                // done
                'price_id'=> 4,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0002',
                'consolidated_qty' => 580,
                'consolidated_amount' => 21460,
                'date'=> \Carbon\Carbon::now()->addDays(103),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
            ],
            [
                // squash for \Carbon\Carbon::now()->addDays(103)
                // done
                'price_id'=> 5,
                'crop_id'=> 5,
                'variety_id'=> 11,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0003',
                'consolidated_qty' => 800,
                'consolidated_amount' => 11256,
                'date'=> \Carbon\Carbon::now()->addDays(103),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
            ],
            [
                // pechay for \Carbon\Carbon::now()->addDays(60)
                // done
                'price_id'=> 8,
                'crop_id'=> 8,
                'variety_id'=> null,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0004',
                'consolidated_qty' => 160,
                'consolidated_amount' => 7961.60,
                'date'=> \Carbon\Carbon::now()->addDays(60),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(3),
            ],
            [
                // Cauliflower for \Carbon\Carbon::now()->addDays(110)
                // done
                'price_id'=> 13,
                'crop_id'=> 13,
                'variety_id'=> null,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0005',
                'consolidated_qty' => 200,
                'consolidated_amount' => 17742,
                'date'=> \Carbon\Carbon::now()->addDays(110),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(3),
            ],
            [
                // Baguio Beans for \Carbon\Carbon::now()->addDays(80)
                // done
                'price_id'=> 19,
                'crop_id'=> 19,
                'variety_id'=> null,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0006',
                'consolidated_qty' => 380,
                'consolidated_amount' => 19820.80,
                'date'=> \Carbon\Carbon::now()->addDays(80),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(5),
            ],
            [
                // Ampalaya for  \Carbon\Carbon::now()->addDays(90)
                // done
                'price_id'=> 1,
                'crop_id'=> 1,
                'variety_id'=> null,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-111822-0007',
                'consolidated_qty' => 1000,
                'consolidated_amount' => 49510,
                'created_at'=> \Carbon\Carbon::now()->subDays(4),
                'status'=> 'pooling',
                'date'=> \Carbon\Carbon::now()->addDays(90)
            ],
            [
                // eggplant for \Carbon\Carbon::now()->addDays(120)
                // done
                'price_id'=> 2,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-111822-0008',
                'consolidated_qty' => 1000,
                'consolidated_amount' => 35460,
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'status'=> 'pooling',
                'date'=> \Carbon\Carbon::now()->addDays(120)
            ],
            [
                // cauliflower for 2022-11-23
                // done
                'price_id'=> 13,
                'crop_id'=> 13,
                'variety_id'=> null,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-112322-0009',
                'consolidated_qty' => 1000,
                'consolidated_amount' => 88710,
                'created_at'=> \Carbon\Carbon::now()->subDays(7),
                'status'=> 'pooling',
                'date'=> \Carbon\Carbon::now()->addDays(116)
            ],

            /* For August */
            [
                // eggplant for \Carbon\Carbon::now()->subdays(115) 
                // done
                'price_id'=> 2,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0010',
                'consolidated_qty' => 300,
                'consolidated_amount' => 10638,
                'date'=> \Carbon\Carbon::now()->addDays(2),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
            ],

            [
                // tomato for \Carbon\Carbon::now()->addDays(103)
                // done
                'price_id'=> 4,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-00011',
                'consolidated_qty' => 400,
                'consolidated_amount' => 14800,
                'date'=> \Carbon\Carbon::now()->addDays(5),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
            ],
            
            [
                // Baguio Beans for \Carbon\Carbon::now()->addDays(80)
                // done
                'price_id'=> 19,
                'crop_id'=> 19,
                'variety_id'=> null,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-00012',
                'consolidated_qty' => 760,
                'consolidated_amount' => 39641.6,
                'date'=> \Carbon\Carbon::now()->addDays(7),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(75),
            ],

            [
                // Baguio Beans for \Carbon\Carbon::now()->addDays(80)
                // done
                'price_id'=> 4,
                'crop_id'=> 4,
                'variety_id'=> null,
                'class_id'=> null,
                'pool_no' => 'BXU-PRE-081722-0013',
                'consolidated_qty' => 400,
                'consolidated_amount' => 14800,
                'date'=> \Carbon\Carbon::now()->addDays(7),
                'status'=> 'pooling',
                'created_at'=> \Carbon\Carbon::now()->subDays(75),
            ],

            /* For August */

        ]);
    }
}
