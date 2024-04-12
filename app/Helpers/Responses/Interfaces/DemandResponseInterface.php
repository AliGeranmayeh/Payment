<?php


namespace App\Helpers\Responses\Interfaces;

use App\Models\Demand;


interface DemandResponseInterface
{
    public static function index($demands);
    public static function store(Demand|null $demand);
    public static function show(Demand $demands);
    public static function changeStatus();
    public static function download(string $filePath);

}