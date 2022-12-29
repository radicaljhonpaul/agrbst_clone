<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminFarmerRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin_farmer_requests')->insert([

            [
                'from_user' => 1,
                'to_user' => 4,
                'crop_id'=> 1,
                'variety_id'=> null,
                'class_id' => null,
                'route' => 'a-f',
                'requested_qty' => 300,
                'amount' => 10113, //farm gate price
                'created_at'=> \Carbon\Carbon::now()->subDays(2),
                'status' => 'pending',
                'remarks' => 'e accept sir please. need nakog suppply. thanks!!!'
            ],
            [
                'from_user' => 1,
                'to_user' => 7,
                'crop_id'=> 2,
                'variety_id'=> null,
                'class_id' => null,
                'route' => 'a-f',
                'requested_qty' => 190,
                'amount' => 4383.3, //farm gate price
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'status' => 'pending',
                'remarks' => 'e accept sir please. need nakog suppply. thanks!!!'
            ],
            [
                'from_user' => 1,
                'to_user' => 12,
                'crop_id'=> 3, //shelf life 1 week. static
                'variety_id'=> null,
                'class_id' => null,
                'route' => 'a-f',
                'requested_qty' => 300,
                'amount' => 4980, //farm gate price
                'created_at'=> \Carbon\Carbon::now()->subDays(5),
                'status' => 'approved',
                'remarks' => 'e accept sir please. need nakog suppply. thanks!!!'
            ],
            [
                'from_user' => 9,
                'to_user' => 1,
                'crop_id'=> 2,
                'variety_id'=> null,
                'class_id' => null,
                'route' => 'f-a',
                'requested_qty' => 600,
                'amount' => 13842, //farm gate price
                'created_at'=> \Carbon\Carbon::now()->subDays(3),
                'status' => 'pending',
                'remarks' => 'naa koy sobra nga supply sir. basin gusto nimo ni kuhaon hehehe. salamat kaayo sir hehehe.'
            ],
            [
                'from_user' => 17,
                'to_user' => 1,
                'crop_id'=> 2, //shelf life 1 week. static
                'variety_id'=> null,
                'class_id' => null,
                'route' => 'f-a',
                'requested_qty' => 200,
                'amount' => 4614, //farm gate price
                'created_at'=> \Carbon\Carbon::now()->subDays(4),
                'status' => 'approved',
                'remarks' => 'naa koy sobra nga supply sir. basin gusto nimo ni kuhaon hehehe. salamat kaayo sir hehehe.'
            ],
            [
                'from_user' => 16,
                'to_user' => 1,
                'crop_id'=> 2,
                'variety_id'=> null,
                'class_id' => null,
                'route' => 'f-a',
                'requested_qty' => 400,
                'amount' => 9228, //farm gate price
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'status' => 'pending',
                'remarks' => 'naa koy sobra nga supply sir. basin gusto nimo ni kuhaon hehehe. salamat kaayo sir hehehe.'
            ],
            
        ]);
        
    }
}
