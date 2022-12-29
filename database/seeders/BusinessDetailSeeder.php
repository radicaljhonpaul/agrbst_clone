<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('business_details')->insert([
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 18,
                'business_name'=> 'the business 1',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '2356233432',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> '5342423423423bugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 19,
                'business_name'=> 'the business 2',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '73856745645',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 20,
                'business_name'=> 'the business 3',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '856343623523',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 21,
                'business_name'=> 'the business 4',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '734562347834',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 22,
                'business_name'=> 'the business 5',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '745945435235',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 23,
                'business_name'=> 'the business 6',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '745952342323',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 24,
                'business_name'=> 'the business 7',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '912342376345',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 25,
                'business_name'=> 'the business 8',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '15234734237',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 26,
                'business_name'=> 'the business 9',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '373456348673',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 27,
                'business_name'=> 'the business 10',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '637234126343',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 28,
                'business_name'=> 'the business 11',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '7232372344234',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 29,
                'business_name'=> 'the business 12',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '1245347234234',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 30,
                'business_name'=> 'the business 13',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '2472345234823',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 31,
                'business_name'=> 'the business 14',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '6234782342334',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            [
                'created_at'=> \Carbon\Carbon::now(),
                'updated_at'=> \Carbon\Carbon::now(),
                'deleted_at' => null,
                'user_detail_id'=> 32,
                'business_name'=> 'the joe trader business15',
                'nature_of_business'=> 'service business',
                'business_permit_no'=> '235612323723',
                'region'=> 'caraga',
                'province'=> 'agusan del norte',
                'city'=> 'butuan city',
                'brgy'=> 'pangabugan',
                'long'=> 1213,
                'lat'=> 14123
            ],
            
        ]);

    }
}
