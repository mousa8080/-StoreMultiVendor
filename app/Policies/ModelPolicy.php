<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Str;

class ModelPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function __call($name, $arguments)
    {
        $calss_name =str_replace('Policy', '', class_basename($this));
        $calss_name=Str::plural(Str::lower($calss_name));
        $ability=$calss_name.'.'.Str::Kebab($name);
        $user=$arguments[0];
        return $user->hasAbility($ability);

       
    }

}
