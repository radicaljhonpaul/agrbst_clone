<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CropProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('crop_productions')->insert([
            
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 1,
                'dr'=> 0.5,
                'dh'=> 4,
                'maturity_from'=> 65,
                'maturity_to'=> 70,
                'harvesting'=> '2',
                'qty_hills'=> 425
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 2,
                'dr'=> 0.5,
                'dh'=> 1.5,
                'maturity_from'=> 90,
                'maturity_to'=> 90,
                'harvesting'=> '2',
                'qty_hills'=> 933
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 3,
                'dr'=> 0.5,
                'dh'=> 1,
                'maturity_from'=> 60,
                'maturity_to'=> 60,
                'harvesting'=> '3',
                'qty_hills'=> 1600
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 4,
                'dr'=> 0.25,
                'dh'=> 1.5,
                'maturity_from'=> 85,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 2133
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 5,
                'dr'=> 2,
                'dh'=> 2,
                'maturity_from'=> 90,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 200
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 6,
                'dr'=> 0.3,
                'dh'=> 1,
                'maturity_from'=> 50,
                'maturity_to'=> 55,
                'harvesting'=> '3',
                'qty_hills'=> 2667
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 7,
                'dr'=> 0.2,
                'dh'=> 1.5,
                'maturity_from'=> 40,
                'maturity_to'=> 45,
                'harvesting'=> '3',
                'qty_hills'=> 2667
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 8,
                'dr'=> 0.2,
                'dh'=> 0.2,
                'maturity_from'=> 28,
                'maturity_to'=> 35,
                'harvesting'=> '1',
                'qty_hills'=> 15000
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 9,
                'dr'=> 0.1,
                'dh'=> 0.15,
                'maturity_from'=> 30,
                'maturity_to'=> 35,
                'harvesting'=> '1',
                'qty_hills'=> 56667
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 10,
                'dr'=> 4,
                'dh'=> 1,
                'maturity_from'=> 70,
                'maturity_to'=> 75,
                'harvesting'=> '2',
                'qty_hills'=> 200
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 11,
                'dr'=> 4,
                'dh'=> 1,
                'maturity_from'=> 70,
                'maturity_to'=> 75,
                'harvesting'=> '2',
                'qty_hills'=> 200
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 12,
                'dr'=> 0.25,
                'dh'=> 1.5,
                'maturity_from'=> 90,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 2133
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 13,
                'dr'=> 0.25,
                'dh'=> 1.5,
                'maturity_from'=> 90,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 2133
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 14,
                'dr'=> 0.25,
                'dh'=> 1.5,
                'maturity_from'=> 90,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 2133
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 15,
                'dr'=> 0.25,
                'dh'=> 1.5,
                'maturity_from'=> 90,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 2133
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 16,
                'dr'=> 2,
                'dh'=> 4,
                'maturity_from'=> 110,
                'maturity_to'=> 120,
                'harvesting'=> '1',
                'qty_hills'=> 100
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 17,
                'dr'=> 0.2,
                'dh'=> 0.5,
                'maturity_from'=> 120,
                'maturity_to'=> 120,
                'harvesting'=> '1',
                'qty_hills'=> 8000
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 18,
                'dr'=> 0.3,
                'dh'=> 0.5,
                'maturity_from'=> 90,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 5333
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 19,
                'dr'=> 0.4,
                'dh'=> 0.75,
                'maturity_from'=> 55,
                'maturity_to'=> 60,
                'harvesting'=> '3',
                'qty_hills'=> 2667
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 20,
                'dr'=> 0.25,
                'dh'=> 1.5,
                'maturity_from'=> 35,
                'maturity_to'=> 40,
                'harvesting'=> '1',
                'qty_hills'=> 2133
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 21,
                'dr'=> 0.4,
                'dh'=> 1,
                'maturity_from'=> 240,
                'maturity_to'=> 300,
                'harvesting'=> '1',
                'qty_hills'=> 1875
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 22,
                'dr'=> 0.2,
                'dh'=> 0.2,
                'maturity_from'=> 120,
                'maturity_to'=> 120,
                'harvesting'=> '1',
                'qty_hills'=> 18750
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 23,
                'dr'=> 0.2,
                'dh'=> 0.2,
                'maturity_from'=> 35,
                'maturity_to'=> 40,
                'harvesting'=> '1',
                'qty_hills'=> 21750
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 24,
                'dr'=> 0.4,
                'dh'=> 0.5,
                'maturity_from'=> 75,
                'maturity_to'=> 85,
                'harvesting'=> '1',
                'qty_hills'=> 3750
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'crop_id'=> 25,
                'dr'=> 0.4,
                'dh'=> 0.4,
                'maturity_from'=> 85,
                'maturity_to'=> 90,
                'harvesting'=> '1',
                'qty_hills'=> 5000
            ]
        ]);
        
    }
}
