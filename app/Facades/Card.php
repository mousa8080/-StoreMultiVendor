<?php
namespace App\Facades;

use App\Repositories\card\CardRepositories;
use Illuminate\Support\Facades\Facade;

class Card extends Facade
{
    protected static function getFacadeAccessor()
    {
        return  CardRepositories::class;
    }
}