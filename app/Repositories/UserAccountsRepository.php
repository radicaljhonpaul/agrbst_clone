<?php

namespace App\Repositories;

use App\Interfaces\UserAccountsInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserAccountsRepository implements UserAccountsInterface 
{

    public function getAllUserAccounts() 
    {
        return User::all();
    }
    
    public function getUserAccountByType($type) // Params: 'farmer' / 'trader' 
    {   
        $User = User::query();
        if($type == 'farmer'){
            $User->selectRaw('id, lpad(id, 4, 0) '.'AS officialID'.' , email, user_type, status, created_at, updated_at')->with(['UserDetail' => function($data){
                return  $data->select('id','user_id','fname','lname','phone')
                        ->with(['FarmDetail' => function($data){
                            return $data->select('id','user_detail_id','farm_name')->get();
                    }])->get();
            }])->where('user_type',$type);
        }else{
            $User->selectRaw('id, lpad(id, 4, 0) '.'AS officialID'.' , email, user_type, status, created_at, updated_at')->with(['UserDetail' => function($data){
                return  $data->select('id','user_id','fname','lname','sex','bday','phone','region','province','city','brgy','long','lat')
                        ->with(['BusinessDetail' => function($data){
                            return $data->select('id','user_detail_id','business_name','nature_of_business','business_permit_no','region','province','city','brgy','long','lat')->get();
                    }])->get();
            }])->where('user_type',$type);
        }
        return $User;
    }

    public function getUserAccountByTypeAndId($userId,$type)
    {
        $User = User::query();
        if($type == 'farmer'){
            $User->selectRaw('id, lpad(id, 4, 0) '.'AS officialID'.' , email, user_type, status, created_at, updated_at')->with(['UserDetail' => function($data){
                return  $data->select('id','user_id','fname','lname','sex','bday','phone','region','province','city','brgy','long','lat')
                        ->with(['FarmDetail' => function($data){
                            return $data->select('id','user_detail_id','farm_name','farm_size','region','province','city','brgy','long','lat')->get();
                    }])->get();
            }])
            ->where('user_type',$type)
            ->where('id',$userId);
        }else{
            $User->selectRaw('id, lpad(id, 4, 0) '.'AS officialID'.' , email, user_type, status, created_at, updated_at')->with(['UserDetail' => function($data){
                return  $data->select('id','user_id','fname','lname','sex','bday','phone','region','province','city','brgy','long','lat')
                        ->with(['BusinessDetail' => function($data){
                            return $data->select('id','user_detail_id','business_name','nature_of_business','business_permit_no','region','province','city','brgy','long','lat')->get();
                    }])->get();
            }])
            ->where('user_type',$type)
            ->where('id',$userId);
        }
        return $User;
    }

    public function approveUserAccountByID($userId) 
    {
        return User::where('id', $userId)->update(['status' => 'approved']);
    }

    public function searchUserAccount($params) 
    {
        // return
    }

    public function deleteUserAccount($userId) 
    {
        return User::destroy($userId);
    }

    public function updateUserAccountStatus($userId, $status) 
    {
        return User::where('id', $userId)->update(['status' => $status]);
    }


}
