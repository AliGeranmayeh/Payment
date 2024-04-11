<?php


namespace App\Helpers\DB;
use App\Models\User;

class UserRepository
{

    public static function create(array $data)
    {
        if (array_key_exists('national_code', $data)) {
            $human = HumanRepository::find(['national_code' => $data['national_code']]);
        }

        if (array_key_exists('human_id', $data)) {
            $human = HumanRepository::find(['human_id' => $data['human_id']]);
        }

        return $human ? 
            User::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'human_id' => $human->id
        ]) : null;
    }
}