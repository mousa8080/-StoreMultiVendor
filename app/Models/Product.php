<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',
    ];

    protected  static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'products_tag', 'product_id', 'tag_id', 'id', 'id');
    }
    public function scopeActive(Builder $builder)
    {

        return $builder->where('status', 'active');
    }
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return "https://media.istockphoto.com/id/1396814518/vector/image-coming-soon-no-photo-no-thumbnail-image-available-vector-illustration.jpg?s=612x612&w=0&k=20&c=hnh2OZgQGhf0b46-J2z7aHbIWwq8HNlSDaNp2wn_iko=";
        }
        // if(Str::startsWith($this->image, 'http://') || Str::startsWith($this->image, 'https://')){
        //     return $this->image;
        // }
        // return asset('storage/' . $this->image);
    }
    public function getDiscountPercentageAttribute()
    {
        if ($this->compare_price) {
            return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
        return 0;
    }
}
