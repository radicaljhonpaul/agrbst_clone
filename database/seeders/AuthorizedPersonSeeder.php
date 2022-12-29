<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorizedPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('authorized_people')->insert(
            [
                [
                    "created_at"=> \Carbon\Carbon::now(),
                    "updated_at"=> \Carbon\Carbon::now(),
                    
                    "user_id"=> 19,
                    "fname"=> 'trader 1 authorized 1',
                    "lname"=> 'person',
                    "sex"=>"male",
                    "phone"=>'09152342234'
                ],
                [
                    "created_at"=> \Carbon\Carbon::now(),
                    "updated_at"=> \Carbon\Carbon::now(),
                    
                    "user_id"=> 19,
                    "fname"=> 'trader 1 authorized 2',
                    "lname"=> 'person',
                    "sex"=>"male",
                    "phone"=>'09152511231'
                ],
                [
                    "created_at"=> \Carbon\Carbon::now(),
                    "updated_at"=> \Carbon\Carbon::now(),
                    
                    "user_id"=> 19,
                    "fname"=> 'trader 1 authorized 3',
                    "lname"=> 'person',
                    "sex"=>"male",
                    "phone"=>'09152576575'
                ],
                [
                    "created_at"=> \Carbon\Carbon::now(),
                    "updated_at"=> \Carbon\Carbon::now(),
                    
                    "user_id"=> 21,
                    "fname"=> 'trader 3 authorized 1',
                    "lname"=> 'person',
                    "sex"=>"female",
                    "phone"=>'09152576574'
                ],
                [
                    "created_at"=> \Carbon\Carbon::now(),
                    "updated_at"=> \Carbon\Carbon::now(),
                    
                    "user_id"=> 21,
                    "fname"=> 'trader 3 authorized 2',
                    "lname"=> 'person',
                    "sex"=>"male",
                    "phone"=>'09152576572'
                ],
                [
                    "created_at"=> \Carbon\Carbon::now(),
                    "updated_at"=> \Carbon\Carbon::now(),
                    
                    "user_id"=> 22,
                    "fname"=> 'trader 4 authorized 1',
                    "lname"=> 'person',
                    "sex"=>"male",
                    "phone"=>'09152476575'
                ],
                [
                    "created_at"=> \Carbon\Carbon::now(),
                    "updated_at"=> \Carbon\Carbon::now(),
                    
                    "user_id"=> 22,
                    "fname"=> 'trader 4 authorized 2',
                    "lname"=> 'person',
                    "sex"=>"male",
                    "phone"=>'09152998890'
                ],
            ]);
    }
}
