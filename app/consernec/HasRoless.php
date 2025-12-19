<?php

namespace App\consernec;

use App\Models\Role;
use App\Models\Ability;

trait HasRoless
{
    public function roles()
    {
        return $this->morphToMany(Role::class, 'authenticatable', 'role_user');
    }
    public function hasAbilities($ability)
    {
        $denied = $this->roles()->wherehas('abilities', function ($query) use ($ability) {
            $query->where('ability', $ability)
                ->where('type', 'deny');
        })->exists();
        if($denied){
            return false;
        }
        return $this->roles()->wherehas('abilities', function ($query) use ($ability) {
            $query->where('ability', $ability)
                ->where('type', 'allow');
        })->exists();
    }
}
