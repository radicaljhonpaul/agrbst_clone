<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ShelfLifeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shelf_lives')->insert([

            [
                'crop_id' => 2,
                'no_of_days' => 3
            ],
            [
                'crop_id' => 3,
                'no_of_days' => 3
            ],
            
        ]);
    }
}
