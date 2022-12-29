<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MappedTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('mapped_transactions')->insert([

            [
                // [ eggplant - 100 kilos = 3,546 ], [ tomato - 200 kilos = 7,400 ], [ squash - 400 kilos = 5,628]
                // done
                'user_id'=> 19,
                'transaction_no'=>'BXU-PRE-081722-0001',
                'transaction_type'=>'demand',
                'amount'=> 16574,
                'created_at' => \Carbon\Carbon::now()->subDays(2),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ pechay - 160 kilos = 7,961.6 ], [ Cauliflower - 200 kilos = 17,742 ]
                // done
                'user_id'=> 25,
                'transaction_no'=>'BXU-PRE-121922-0002',
                'transaction_type'=>'demand',
                'amount'=> 25703.6,
                'created_at' =>\Carbon\Carbon::now()->subDays(3),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ Baguio Beans - 380 kilos = 19,820.8]
                // done
                'user_id'=> 25,
                'transaction_no'=>'BXU-PRE-121922-0003',
                'transaction_type'=>'demand',
                'amount'=> 19820.8,
                'created_at' => \Carbon\Carbon::now()->subDays(5),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ eggplant - 100 kilos = 3,546 ], [ tomato - 200 kilos = 14,060 ], [ squash - 400 kilos = 5,628]
                // done
                'user_id'=> 30,
                'transaction_no'=>'BXU-PRE-081722-0004',
                'transaction_type'=>'demand',
                'amount'=> 30326,
                'created_at' => \Carbon\Carbon::now()->subDays(2),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ ampalaya 300 kilos * 49.51 ]
                // done
                'user_id'=> 30,
                'transaction_no'=>'BXU-PRE-111822-0005',
                'transaction_type'=>'demand',
                'amount'=> 14853,
                'created_at' => \Carbon\Carbon::now()->subDays(4),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ ampalaya 300 kilos * 49.51 ]
                // done
                'user_id'=> 28,
                'transaction_no'=>'BXU-PRE-111822-0006',
                'transaction_type'=>'demand',
                'amount'=> 14853,
                'created_at' => \Carbon\Carbon::now()->subDays(4),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ ampalaya 400 kilos * 49.51 ]
                // done
                'user_id'=> 27,
                'transaction_no'=>'BXU-PRE-111822-0007',
                'transaction_type'=>'demand',
                'amount'=> 19804,
                'created_at' => \Carbon\Carbon::now()->subDays(4),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ eggplant 300 kilos * 35.46 ]
                // done
                'user_id'=> 25,
                'transaction_no'=>'BXU-PRE-111822-0008',
                'transaction_type'=>'demand',
                'amount'=> 10638,
                'created_at' => \Carbon\Carbon::now()->subDays(1),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ eggplant 300 kilos * 35.46 ]
                // done
                'user_id'=> 19,
                'transaction_no'=>'BXU-PRE-111822-0009',
                'transaction_type'=>'demand',
                'amount'=> 10638,
                'created_at' => \Carbon\Carbon::now()->subDays(1),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ eggplant 400 kilos * 35.46 ]
                // done
                'user_id'=> 33,
                'transaction_no'=>'BXU-PRE-111822-0010',
                'transaction_type'=>'demand',
                'amount'=> 14184,
                'created_at' => \Carbon\Carbon::now()->subDays(1),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ cauliflower 300 kilos * 88.71 ]
                // done
                'user_id'=> 31,
                'transaction_no'=>'BXU-PRE-112322-0011',
                'transaction_type'=>'demand',
                'amount'=> 26613,
                'created_at' => \Carbon\Carbon::now()->subDays(7),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ cauliflower 300 kilos * 88.71 ]
                // done
                'user_id'=> 32,
                'transaction_no'=>'BXU-PRE-112322-0012',
                'transaction_type'=>'demand',
                'amount'=> 26613,
                'created_at' => \Carbon\Carbon::now()->subDays(7),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ cauliflower 400 kilos * 88.71 ]
                // done
                'user_id'=> 26,
                'transaction_no'=>'BXU-PRE-112322-0013',
                'transaction_type'=>'demand',
                'amount'=> 35484,
                'created_at' => \Carbon\Carbon::now()->subDays(7),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],


            [
                // [deposit transaction]
                // done
                'user_id'=> 1,
                'transaction_no'=>'BXU-DPT-110822-0014',
                'transaction_type'=>'deposit',
                'amount'=> 19203,
                'created_at' => \Carbon\Carbon::now()->subDays(1),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [deposit transaction]
                // done
                'user_id'=> 1,
                'transaction_no'=>'BXU-DPT-110822-0015',
                'transaction_type'=>'deposit',
                'amount'=> 4614,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [commit transaction]
                // done
                'user_id'=> 1,
                'transaction_no'=>'BXU-CMT-110822-0016',
                'transaction_type'=>'commit',
                'amount'=> 6921,
                'created_at'=> \Carbon\Carbon::now()->subDays(1),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [commit transaction]
                // done
                'user_id'=> 1,
                'transaction_no'=>'BXU-CMT-110822-0017',
                'transaction_type'=>'commit',
                'amount'=> 6921,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [commit transaction]
                // done
                'user_id'=> 1,
                'transaction_no'=>'BXU-CMT-110822-0018',
                'transaction_type'=>'commit',
                'amount'=> 9228,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            // For August
            [
                // [ eggplant - 100 kilos = 3,546 ]
                'user_id'=> 19,
                'transaction_no'=>'BXU-PRE-081722-00019',
                'transaction_type'=>'demand',
                'amount'=> 16574,
                'created_at' => \Carbon\Carbon::now()->subDays(115),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ eggplant - 100 kilos = 3,546 ]
                'user_id'=> 25,
                'transaction_no'=>'BXU-PRE-081722-00020',
                'transaction_type'=>'demand',
                'amount'=> 16574,
                'created_at' => \Carbon\Carbon::now()->subDays(115),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            
            [
                // [ eggplant - 100 kilos = 3,546 ]
                'user_id'=> 30,
                'transaction_no'=>'BXU-PRE-081722-00021',
                'transaction_type'=>'demand',
                'amount'=> 16574,
                'created_at' => \Carbon\Carbon::now()->subDays(115),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            
            
            [
                // [ tomato - 200 kilos = 7,400 ]
                'user_id'=> 28,
                'transaction_no'=>'BXU-PRE-081722-00022',
                'transaction_type'=>'demand',
                'amount'=> 7400,
                'created_at' => \Carbon\Carbon::now()->subDays(115),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],

            [
                // [ tomato - 200 kilos = 7,400 ]
                'user_id'=> 31,
                'transaction_no'=>'BXU-PRE-081722-00023',
                'transaction_type'=>'demand',
                'amount'=> 7400,
                'created_at' => \Carbon\Carbon::now()->subDays(115),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],

            [
                // [ Baguio Beans - 380 kilos = 19,820.8]
                'user_id'=> 26,
                'transaction_no'=>'BXU-PRE-121922-0024',
                'transaction_type'=>'demand',
                'amount'=> 19820.80,
                'created_at' => \Carbon\Carbon::now()->subDays(75),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ Baguio Beans - 380 kilos = 19,820.8]
                'user_id'=> 24,
                'transaction_no'=>'BXU-PRE-121922-0025',
                'transaction_type'=>'demand',
                'amount'=> 19820.80,
                'created_at' => \Carbon\Carbon::now()->subDays(75),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],

            [
                // [ Tomato - 380 kilos = 19,820.8]
                'user_id'=> 26,
                'transaction_no'=>'BXU-PRE-121922-0026',
                'transaction_type'=>'demand',
                'amount'=> 19820.80,
                'created_at' => \Carbon\Carbon::now()->subDays(115),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
            [
                // [ Tomato - 380 kilos = 19,820.8]
                'user_id'=> 24,
                'transaction_no'=>'BXU-PRE-121922-0027',
                'transaction_type'=>'demand',
                'amount'=> 19820.80,
                'created_at' => \Carbon\Carbon::now()->subDays(115),
                'updated_at' => null,
                'payment_method' => null,
                'status' => 'pending'
            ],
        ]);
    }
}
