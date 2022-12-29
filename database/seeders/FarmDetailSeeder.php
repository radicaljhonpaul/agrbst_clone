<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('farm_details')->insert([
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 1,
                'farm_name'=> "the farmer's farm 1",
                'farm_size'=> 15123,
                'remaining_size' => 15123,
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan',
                'brgy'=> 'dagohoy',
                'long'=> '1312',
                'lat'=> '1234'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 2,
                'farm_name'=> "the farmer's farm 2",
                'farm_size'=> 1512312,
                'remaining_size' => 1512312,
                'region'=> 'caraga',
                'province'=> 'surigao del sur',
                'city'=> 'bislig',
                'brgy'=> 'dagohoy',
                'long'=> '6754',
                'lat'=> '3151'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 3,
                'farm_name'=> "the farmer's farm 3",
                'farm_size'=> 63453,
                'remaining_size' => 63453,
                'region'=> 'caraga',
                'province'=> 'surigao del sur',
                'city'=> 'bislig',
                'brgy'=> 'dagohoy',
                'long'=> '2151',
                'lat'=> '5123'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 4,
                'farm_name'=> "the farmer's farm 4",
                'farm_size'=> 13141,
                'remaining_size' => 13141,
                'region'=> 'caraga',
                'province'=> 'surigao del sur',
                'city'=> 'bislig',
                'brgy'=> 'dagohoy',
                'long'=> '9555',
                'lat'=> '6445'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 5,
                'farm_name'=> "the farmer's farm 5",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'surigao del sur',
                'city'=> 'cantilan',
                'brgy'=> 'dagohoy',
                'long'=> '1473',
                'lat'=> '9673'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 6,
                'farm_name'=> "the farmer's farm 6",
                'farm_size'=> 10501,
                'remaining_size' => 10501,
                'region'=> 'caraga',
                'province'=> 'surigao del sur',
                'city'=> 'cantilan',
                'brgy'=> 'dagohoy',
                'long'=> '4332',
                'lat'=> '1246'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 7,
                'farm_name'=> "the farmer's farm 7",
                'farm_size'=> 10506,
                'remaining_size' => 6131.26,
                'region'=> 'caraga',
                'province'=> 'surigao del sur',
                'city'=> 'cantilan',
                'brgy'=> 'dagohoy',
                'long'=> '6727',
                'lat'=> '5236'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 8,
                'farm_name'=> "the farmer's farm 8",
                'farm_size'=> 10554,
                'remaining_size' => 7272.94,
                'region'=> 'caraga',
                'province'=> 'surigao del sur',
                'city'=> 'cagwait',
                'brgy'=> 'dagohoy',
                'long'=> '8424',
                'lat'=> '6235'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 9,
                'farm_name'=> "the farmer's farm 9",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'surigao del norte',
                'city'=> 'tagana-an',
                'brgy'=> 'dagohoy',
                'long'=> '9233',
                'lat'=> '1267'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 10,
                'farm_name'=> "the farmer's farm 10",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'surigao del norte',
                'city'=> 'tagana-an',
                'brgy'=> 'dagohoy',
                'long'=> '8945',
                'lat'=> '3442'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 11,
                'farm_name'=> "the farmer's farm 11",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'surigao del norte',
                'city'=> 'tagana-an',
                'brgy'=> 'dagohoy',
                'long'=> '7512',
                'lat'=> '9612'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 12,
                'farm_name'=> "the farmer's farm 12",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'surigao del norte',
                'city'=> 'alegria',
                'brgy'=> 'dagohoy',
                'long'=> '1112',
                'lat'=> '8435'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 13,
                'farm_name'=> "the farmer's farm 13",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'surigao del norte',
                'city'=> 'alegria',
                'brgy'=> 'dagohoy',
                'long'=> '1312',
                'lat'=> '8933'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 14,
                'farm_name'=> "the farmer's farm 14",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'agusan del sur',
                'city'=> 'san francisco',
                'brgy'=> 'dagohoy',
                'long'=> '1312',
                'lat'=> '6344'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 15,
                'farm_name'=> "the farmer's farm 15",
                'farm_size'=> 10500,
                'remaining_size' => 7218.94,
                'region'=> 'caraga',
                'province'=> 'agusan del sur',
                'city'=> 'prosperidad',
                'brgy'=> 'dagohoy',
                'long'=> '8345',
                'lat'=> '1234'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 16,
                'farm_name'=> "the farmer's farm 16",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'agusan del sur',
                'city'=> 'prosperidad',
                'brgy'=> 'dagohoy',
                'long'=> '1434',
                'lat'=> '1234'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'user_detail_id'=> 17,
                'farm_name'=> "the farmer's farm 17",
                'farm_size'=> 10500,
                'remaining_size' => 10500,
                'region'=> 'caraga',
                'province'=> 'agusan del sur',
                'city'=> 'san francisco',
                'brgy'=> 'dagohoy',
                'long'=> '1312',
                'lat'=> '7567'
            ],
            
        ]);
    }
}
