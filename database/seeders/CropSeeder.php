<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('crops')->insert([

        	[
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'name' => 'Bitter Gourd (Ampalaya)',
                'seasonality' => 'Dry Season',
                'crop_type' => 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 8,

        	],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Eggplant',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 24,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Lady finger',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 8,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Tomato',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 4,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Squash',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 4,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'String beans',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 4,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Cucumber',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 7,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Pechay',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Water Spinach (Kangkong)',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Patola/luffah',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 8,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Bottle gourd',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'LOWLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 8,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Broccolli',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Cauliflower',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Cabbage',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Chinese cabbage',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Chayote',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 40,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Carrot',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Potato',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Baguio Beans',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 1,
                'no_of_weeks'=> 4,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Lettuce (Curly)',
                'seasonality'=> 'Dry Season',
                'crop_type'=> 'HIGHLAND VEGETABLES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Ginger',
                'seasonality'=> 'Dry Seasonality',
                'crop_type'=> 'SPICES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Onion (Bulb)',
                'seasonality'=> 'Dry Seasonality',
                'crop_type'=> 'SPICES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Onion (spring)',
                'seasonality'=> 'Dry Seasonality',
                'crop_type'=> 'SPICES',
                'successive'=> 0,
                'no_of_weeks'=> null,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Hot Pepper',
                'seasonality'=> 'Dry Seasonality',
                'crop_type'=> 'SPICES',
                'successive'=> 1,
                'no_of_weeks'=> 7,
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'name'=> 'Sweet pepper',
                'seasonality'=> 'Dry Seasonality',
                'crop_type'=> 'SPICES',
                'successive'=> 1,
                'no_of_weeks'=> 7,
            ]
            


        ]);
    }
}
