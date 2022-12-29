<?php

namespace App\Interfaces;

interface UserAccountsInterface 
{
    public function getAllUserAccounts();
    public function getUserAccountByType($type);
    public function getUserAccountByTypeAndId($userId,$type);
    public function approveUserAccountByID($userId);
    public function searchUserAccount($userId);
    public function deleteUserAccount($userId);
    public function updateUserAccountStatus($userId, $status);
}