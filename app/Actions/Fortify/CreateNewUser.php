<?php

namespace App\Actions\Fortify;

use App\Models\Entity_Details;
use App\Models\Farm_Details;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use App\Models\Users_Details;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        // Validator::make($input, [
        //     // 'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => $this->passwordRules(),
        //     'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        // ])->validate();

        // return User::create([
        //     // 'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);

        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();


        $user_data = User::create([
            'email' => $input['email'],
            'user_type' => $input['user_type'],
            'password' => Hash::make($input['password']),
        ]);

        if($user_data){

            $User = User::select('id','email')->where('email',$input['email'])->get();

            $UserDetails = new Users_Details();
            $UserDetails->fk_user_id = $User['0']['id'];
            $UserDetails->fname = $input['fname'];
            $UserDetails->lname = $input['lname'];
            $UserDetails->sex = $input['sex'];
            $UserDetails->bday = $input['bday'];
            $UserDetails->phone = $input['phone'];
            $UserDetails->fk_entity_address = $input['fk_entity_details'];
            $UserDetails->fk_home_address = $input['fk_farm_details'];
            $UserDetails->save();

            $Entity_Details = new Entity_Details();
            $Entity_Details->entity_name = $input['entity_name'];
            $Entity_Details->nature_of_entity = $input['nature_of_entity'];
            $Entity_Details->business_permit_no = $input['business_permit_no'];
            $Entity_Details->region = $input['region'];
            $Entity_Details->province = $input['province'];
            $Entity_Details->city = $input['city'];
            $Entity_Details->brgy = $input['brgy'];
            $Entity_Details->long = $input['long'];
            $Entity_Details->lat = $input['lat'];
            $Entity_Details->fk_users_details_id = $input['fk_users_details_id'];
            $Entity_Details->save();

            $Farm_Details = new Farm_Details();
            $Farm_Details->farm_name = $input['farm_name'];
            $Farm_Details->farm_size = $input['farm_size'];
            $Farm_Details->region = $input['region'];
            $Farm_Details->province = $input['province'];
            $Farm_Details->city = $input['city'];
            $Farm_Details->brgy = $input['brgy'];
            $Farm_Details->long = $input['long'];
            $Farm_Details->lat = $input['lat'];
            $Farm_Details->fk_users_details_id = $input['fk_users_details_id'];
            $Farm_Details->save();

        }else;
    
        return $user_data;

    }
}
