<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
        use SoftDeletes, HasFactory;
        protected $connection='mysql';
        protected $table='stores';
        protected $primaryKey='id';
        public $incrementing =true; //is just public
        public $timestamps=true; //is just public

        public function products(){

                return $this->hasMany(Product::class, 'store_id', 'id');
        }
        
}
