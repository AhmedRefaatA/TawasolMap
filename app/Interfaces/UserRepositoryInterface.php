<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function findOrCreate(array $data);
}