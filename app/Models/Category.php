<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class Category extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [ // بيتخذن
        'name',
        'slug',
        'parent_id',
        'discription',
        'image',
        'status',
    ];
    // protected $guarded = [
    // 'id',
    // 'created_at',
    // 'updated_at',
    // ]; //ممنوع يتخذن
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault('-');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    public function scopeStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }
    public function scopeFilter(Builder $query, $filter)
    {
        $query->when($filter['name'] ?? false, function ($query, $value) {
            $query->where('categories.name', 'like', "%{$value}%");
        });
        $query->when($filter['status'] ?? false, function ($query, $value) {
            $query->where('categories.status', $value);
        });
        return $query;
    }

    public static function rules($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                //   "uniqe:categories,name,$id",
                Rule::unique('categories', 'name')->ignore($id),
                //    function($attribute,$value,$fail){
                //     if($value == 'laravel'){
                //         $fail('this name is forbidden! '.$attribute);
                //     }
                //    }
                'filter:laravel,php',
                // new Filter(['laravel','php']),// the tow method

            ],

            'parent_id' => [
                'nullable',
                'int',
                'exists:categories,id',
            ],

            'image' => [
                'image',
                'max:102400',
                // 'mimes:jpeg,png,jpg,gif,svg',
                // 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ],
            'status' => 'in:active,archived',
        ];
    }
}
