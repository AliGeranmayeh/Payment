<?php


namespace App\Helpers\DB;
use App\Models\Human;


class HumanRepository
{
    public static function exist(array $data)
    {

        $human = Human::query()
            ->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->where($key, $value);
            }
        })
            ->first();

        return $human ? true : false;

    }


    public static function find(array $data)
    {

        $human = Human::query()
            ->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->where($key, $value);
            }
        })
            ->first();

        return $human;

    }
}
