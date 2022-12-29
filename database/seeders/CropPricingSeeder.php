<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CropPricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('crop_pricings')->insert(
        [
            [
                'crop_id'=> 1,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 33.71,
                "smp"=> 49.51
            ],
            [
                'crop_id'=> 2,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 23.07,
                "smp"=> 35.46
            ],
            [
                'crop_id'=> 3,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 16.6,
                "smp"=> 26
            ],
            [
                'crop_id'=> 4,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 24.94,
                "smp"=> 37
            ],
            [
                'crop_id'=> 5,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 7.77,
                "smp"=> 14.07
            ],
            [
                'crop_id'=> 6,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 21.32,
                "smp"=> 32.22
            ],
            [
                'crop_id'=> 7,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 17.93,
                "smp"=> 27.75
            ],
            [
                'crop_id'=> 8,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 34.5,
                "smp"=> 49.76
            ],
            [
                'crop_id'=> 9,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 23.72,
                "smp"=> 35.14
            ],
            [
                'crop_id'=> 10,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 27.03,
                "smp"=> 40.03
            ],
            [
                'crop_id'=> 11,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 17.01,
                "smp"=> 28.12
            ],
            [
                'crop_id'=> 12,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 64.95,
                "smp"=> 88.95
            ],
            [
                'crop_id'=> 13,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 64.01,
                "smp"=> 88.71
            ],
            [
                'crop_id'=> 14,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 32.39,
                "smp"=> 46.97
            ],
            [
                'crop_id'=> 15,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 55.83,
                "smp"=> 77.92
            ],
            [
                'crop_id'=> 16,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 5.64,
                "smp"=> 11.27
            ],
            [
                'crop_id'=> 17,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 34.73,
                "smp"=> 47.32
            ],
            [
                'crop_id'=> 18,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 27.6,
                "smp"=> 41.77
            ],
            [
                'crop_id'=> 19,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 40.69,
                "smp"=> 52.16
            ],
            [
                'crop_id'=> 20,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 67.25,
                "smp"=> 92.99
            ],
            [
                'crop_id'=> 21,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 18.52,
                "smp"=> 28.66
            ],
            [
                'crop_id'=> 22,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 43.16,
                "smp"=> 61.32
            ],
            [
                'crop_id'=> 23,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 28.41,
                "smp"=> 38.1
            ],
            [
                'crop_id'=> 24,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 69.8,
                "smp"=> 97.15
            ],
            [
                'crop_id'=> 25,
                "created_at"=> \Carbon\Carbon::now(),
                "updated_at"=> \Carbon\Carbon::now(),
                "deleted_at"=> null,
                'variety_id'=> null,
                'class_id'=> null,
                'qty'=> 1,
                'unit'=> 'Kilo',
                "fgp"=> 58.96,
                "smp"=> 82.84
            ]
        ]);
    }
}
