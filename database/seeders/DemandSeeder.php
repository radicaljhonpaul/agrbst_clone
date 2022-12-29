<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('demands')->insert([
            [
                // eggplant = 90 days + 13 lead time = 90 days + 13 lead time
                // done
                'user_id'=> 19,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 1,
                'consolidated_demand_id'=> 1,
                'qty' => 100,
                'amount'=> 3546,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
                'remaining_qty'=> 100,
                'date'=> \Carbon\Carbon::now()->addDays(115),
                
            ],
            [
                // tomato = 90 days + 13 lead time
                // done
                'user_id'=> 19,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'mapped_transaction_id'=> 1,
                'consolidated_demand_id'=> 2,
                'qty' => 200,
                'amount'=> 7400,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
                'remaining_qty'=> 200,
                'date'=>  \Carbon\Carbon::now()->addDays(103)
            ],
            [
                // squash = 90 days + 13 lead time
                // done
                'user_id'=> 19,
                'crop_id'=> 5,
                'variety_id'=> 11,
                'class_id'=> null,
                'mapped_transaction_id'=> 1,
                'consolidated_demand_id'=> 3,
                'qty' => 400,
                'amount'=> 5628,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
                'remaining_qty'=> 400,
                'date'=> \Carbon\Carbon::now()->addDays(103)
            ],
            [
                // pechay = 35 days + 13 lead time
                // done
                'user_id'=> 25,
                'crop_id'=> 8,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 2,
                'consolidated_demand_id'=> 4,
                'qty' => 160,
                'amount'=> 7961.60,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(3),
                'remaining_qty'=> 160,
                'date'=> \Carbon\Carbon::now()->addDays(60)
            ],
            [
                // Cauliflower = 90 days + 13 lead time
                // done
                'user_id'=> 25,
                'crop_id'=> 13,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 2,
                'consolidated_demand_id'=> 5,
                'qty' => 200,
                'amount'=> 17742,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(3),
                'remaining_qty'=> 200,
                'date'=> \Carbon\Carbon::now()->addDays(110)
            ],
            [
                // Baguio Beans = 60 days + 13 lead time
                // done
                'user_id'=> 25,
                'crop_id'=> 19,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 3,
                'consolidated_demand_id'=> 6,
                'qty' => 380,
                'amount'=> 19820.80,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(5),
                'remaining_qty'=> 380,
                'date'=> \Carbon\Carbon::now()->addDays(80)
            ],
            [
                // eggplant = 90 days + 13 lead time = 60 days + 13 lead time
                // done
                'user_id'=> 30,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 4,
                'consolidated_demand_id'=> 1,
                'qty' => 300,
                'amount'=> 10638,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
                'remaining_qty'=> 300,
                'date'=> \Carbon\Carbon::now()->addDays(115)
            ],
            [
                // tomato = 90 days + 13 lead time
                // done
                'user_id'=> 30,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'mapped_transaction_id'=> 4,
                'consolidated_demand_id'=> 2,
                'qty' => 380,
                'amount'=> 14060,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
                'remaining_qty'=> 380,
                'date'=> \Carbon\Carbon::now()->addDays(103)
            ],
            [
                // squash = 90 days + 13 lead time
                'user_id'=> 30,
                'crop_id'=> 5,
                'variety_id'=> 11,
                'class_id'=> null,
                'mapped_transaction_id'=> 4,
                'consolidated_demand_id'=> 3,
                'qty' => 400,
                'amount'=> 5628,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
                'remaining_qty'=> 400,
                'date'=> \Carbon\Carbon::now()->addDays(103)
            ],
            [
                // ampalaya = 70 days + 13 lead time
                // done
                'user_id'=> 30,
                'crop_id'=> 1,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 5,
                'consolidated_demand_id'=> 7,
                'qty' => 300,
                'amount'=> 14853,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(4),
                'remaining_qty'=> 300,
                'date'=> \Carbon\Carbon::now()->addDays(90)
            ],
            [
                // ampalaya = 70 days + 13 lead time
                // done
                'user_id'=> 28,
                'crop_id'=> 1,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 6,
                'consolidated_demand_id'=> 7,
                'qty' => 300,
                'amount'=> 14853,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(4),
                'remaining_qty'=> 300,
                'date'=> \Carbon\Carbon::now()->addDays(90)
            ],
            [
                // ampalaya = 70 days + 13 lead time
                // done
                'user_id'=> 27,
                'crop_id'=> 1,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 7,
                'consolidated_demand_id'=> 7,
                'qty' => 400,
                'amount'=> 19804,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(4),
                'remaining_qty'=> 400,
                'date'=> \Carbon\Carbon::now()->addDays(90)
            ],
            [
                // eggplant = 90 days + 13 lead time
                // done
                'user_id'=> 25,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 8,
                'consolidated_demand_id'=> 8,
                'qty' => 300,
                'amount'=> 10638,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'remaining_qty'=> 300,
                'date'=> \Carbon\Carbon::now()->addDays(120)
            ],
            [
                // eggplant = 90 days + 13 lead time
                // done
                'user_id'=> 19,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 9,
                'consolidated_demand_id'=> 8,
                'qty' => 300,
                'amount'=> 10638,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'remaining_qty'=> 300,
                'date'=> \Carbon\Carbon::now()->addDays(120)
            ],
            [
                // eggplant = 90 days + 13 lead time
                // done
                'user_id'=> 33,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 10,
                'consolidated_demand_id'=> 8,
                'qty' => 400,
                'amount'=> 14184,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'remaining_qty'=> 400,
                'date'=> \Carbon\Carbon::now()->addDays(120)
            ],
            [
                // Cauliflower = 90 days + 13 lead time
                // done
                'user_id'=> 31,
                'crop_id'=> 13,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 11,
                'consolidated_demand_id'=> 9,
                'qty' => 300,
                'amount'=> 26613,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(7),
                'remaining_qty'=> 300,
                'date'=> \Carbon\Carbon::now()->addDays(116)
            ],
            [
                // Cauliflower = 90 days + 13 lead time
                // done
                'user_id'=> 32,
                'crop_id'=> 13,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 12,
                'consolidated_demand_id'=> 9,
                'qty' => 300,
                'amount'=> 26613,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(7),
                'remaining_qty'=> 300,
                'date'=> \Carbon\Carbon::now()->addDays(116)
            ],
            [
                // Cauliflower = 90 days + 13 lead time
                // done
                'user_id'=> 26,
                'crop_id'=> 13,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 13,
                'consolidated_demand_id'=> 9,
                'qty' => 400,
                'amount'=> 35484,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(7),
                'remaining_qty'=> 400,
                'date'=> \Carbon\Carbon::now()->addDays(116)
            ],
            // For August
            // eggplant = 90 days + 13 lead time = 90 days + 13 lead time
            [
                'user_id'=> 19,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 19,
                'consolidated_demand_id'=> 10,
                'qty' => 100,
                'amount'=> 3546,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
                'remaining_qty'=> 100,
                'date'=> \Carbon\Carbon::now()->addDays(3),
                
            ],
            [
                'user_id'=> 25,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 20,
                'consolidated_demand_id'=> 10,
                'qty' => 100,
                'amount'=> 3546,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
                'remaining_qty'=> 100,
                'date'=> \Carbon\Carbon::now()->addDays(3),
                
            ],
            [
                'user_id'=> 30,
                'crop_id'=> 2,
                'variety_id'=> 8,
                'class_id'=> null,
                'mapped_transaction_id'=> 21,
                'consolidated_demand_id'=> 10,
                'qty' => 100,
                'amount'=> 3546,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
                'remaining_qty'=> 100,
                'date'=> \Carbon\Carbon::now()->addDays(3),
                
            ],
            
            // tomato = 90 days + 13 lead time
            [
                'user_id'=> 28,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'mapped_transaction_id'=> 22,
                'consolidated_demand_id'=> 11,
                'qty' => 200,
                'amount'=> 7400,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
                'remaining_qty'=> 200,
                'date'=>  \Carbon\Carbon::now()->addDays(5)
            ],
            [
                'user_id'=> 31,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'mapped_transaction_id'=> 23,
                'consolidated_demand_id'=> 11,
                'qty' => 200,
                'amount'=> 7400,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
                'remaining_qty'=> 200,
                'date'=>  \Carbon\Carbon::now()->addDays(5)
            ],

            [
                // Baguio Beans = 60 days + 13 lead time
                // done
                'user_id'=> 25,
                'crop_id'=> 19,
                'variety_id'=> null,
                'class_id'=> null,
                'mapped_transaction_id'=> 3,
                'consolidated_demand_id'=> 12,
                'qty' => 380,
                'amount'=> 19820.80,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(75),
                'remaining_qty'=> 380,
                'date'=> \Carbon\Carbon::now()->addDays(7)
            ],



            // tomato = 90 days + 13 lead time
            [
                'user_id'=> 28,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'mapped_transaction_id'=> 26,
                'consolidated_demand_id'=> 13,
                'qty' => 200,
                'amount'=> 7400,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
                'remaining_qty'=> 200,
                'date'=>  \Carbon\Carbon::now()->addDays(7)
            ],
            [
                'user_id'=> 31,
                'crop_id'=> 4,
                'variety_id'=> 13,
                'class_id'=> null,
                'mapped_transaction_id'=> 27,
                'consolidated_demand_id'=> 13,
                'qty' => 200,
                'amount'=> 7400,
                'status'=> 'on-going',
                'created_at'=> \Carbon\Carbon::now()->subDays(115),
                'remaining_qty'=> 200,
                'date'=>  \Carbon\Carbon::now()->addDays(7)
            ],
            
            // For August

        ]);
    }
}
