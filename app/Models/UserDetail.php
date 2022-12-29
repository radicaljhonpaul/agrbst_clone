<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';
    public $timestamps = true;

    public function userDetailformat(){
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'sex' => $this->sex,
            'bday' => $this->bday,
            'phone' => $this->phone,
            'region' => $this->region,
            'province' => $this->province,
            'city' => $this->city,
            'brgy' => $this->brgy,
            'long' => $this->long,
            'lat' => $this->lat,
        ];
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function BusinessDetail()
    {
        return $this->hasOne(BusinessDetail::class, 'user_detail_id', 'id');
    }

    public function FarmDetail()
    {
        return $this->hasOne(FarmDetail::class, 'user_detail_id', 'id');
    }

}
