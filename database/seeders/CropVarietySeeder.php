<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CropVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('crop_varieties')->insert([
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 1,
                'name'=> 'Sta. Isabelle( Ramgo)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 1,
                'name'=> 'Galaxy F1( East west)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 1,
                'name'=> 'Mestisa ( East West)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 1,
                'name'=> 'Verde Buenas F1 (Ramgo)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 1,
                'name'=> 'Trident 357( Allied Botanical)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 2,
                'name'=> 'Checkmate ( Pilipinas Kaneko)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 2,
                'name'=> 'Morena F1(East west) '
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 2,
                'name'=> 'Fortuner F1(East west)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 2,
                'name'=> 'Jackfruit F1 (East West)'
            ],
            [

                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 2,
                'name'=> 'Calixto F1(East west)'
            ],
            [

                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 5,
                'name'=> 'Suprema F1 ( East West)'
            ],
            [

                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 6,
                'name'=> 'Montenegro (Kaneko)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 4,
                'name'=> 'Diamante Max F1( East west)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 4,
                'name'=> 'Agatona F1 (Ramgo)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 4,
                'name'=> 'Rocky  (syngenta)'
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at'=> null,
                'crop_id'=> 4,
                'name'=> 'Atlas F1( AB)'
            ]
        ]);
    }
}
