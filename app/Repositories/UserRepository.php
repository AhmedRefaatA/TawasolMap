<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function findOrCreate(array $data){
        return  User::firstOrCreate([
            'wialon_id' => $data['id'],
        ], [
            'name' => $data['nm'],
            'password' => bcrypt($data['id']),
            'wialon_id' => $data['id'],
        ]);
    }
}