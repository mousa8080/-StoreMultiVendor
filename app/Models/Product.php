<?php

namespace App\Models;

use App\Http\Controllers\Api\ProductController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $store_id
 * @property int|null $category_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $image
 * @property string $price
 * @property int $quantity
 * @property string|null $compare_price
 * @property string|null $options
 * @property string $rating
 * @property int $featured
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $discount_percentage
 * @property-read mixed $image_url
 * @property-read \App\Models\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static Builder<static>|Product active()
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static Builder<static>|Product newModelQuery()
 * @method static Builder<static>|Product newQuery()
 * @method static Builder<static>|Product onlyTrashed()
 * @method static Builder<static>|Product query()
 * @method static Builder<static>|Product whereCategoryId($value)
 * @method static Builder<static>|Product whereComparePrice($value)
 * @method static Builder<static>|Product whereCreatedAt($value)
 * @method static Builder<static>|Product whereDeletedAt($value)
 * @method static Builder<static>|Product whereDescription($value)
 * @method static Builder<static>|Product whereFeatured($value)
 * @method static Builder<static>|Product whereId($value)
 * @method static Builder<static>|Product whereImage($value)
 * @method static Builder<static>|Product whereName($value)
 * @method static Builder<static>|Product whereOptions($value)
 * @method static Builder<static>|Product wherePrice($value)
 * @method static Builder<static>|Product whereQuantity($value)
 * @method static Builder<static>|Product whereRating($value)
 * @method static Builder<static>|Product whereSlug($value)
 * @method static Builder<static>|Product whereStatus($value)
 * @method static Builder<static>|Product whereStoreId($value)
 * @method static Builder<static>|Product whereUpdatedAt($value)
 * @method static Builder<static>|Product withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Product withoutTrashed()
 * @mixin \Eloquent
 */
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
    protected $hidden = [
        'image',
        'deleted_at',
        'created_at',
        'updated_at',

    ];
    protected $appends = [
        'image_url',
    ];

    protected  static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
        static::creating(
            function (Product $product) {
                $product->slug = Str::slug($product->name);
            }
        );
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
        if (!$this->image) {
            return "https://media.istockphoto.com/id/1396814518/vector/image-coming-soon-no-photo-no-thumbnail-image-available-vector-illustration.jpg?s=612x612&w=0&k=20&c=hnh2OZgQGhf0b46-J2z7aHbIWwq8HNlSDaNp2wn_iko=";
        }
        if (!Str::startsWith($this->image, 'http://') && !Str::startsWith($this->image, 'https://')) {
            return asset('storage/' . $this->image);
        }
        return asset('storage/' . $this->image);
    }      
    public function getDiscountPercentageAttribute()
    {
        if ($this->compare_price) {
            return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
        return 0;
    }

    public function scopeFilter(Builder $builder, array $filter)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
        ], $filter);

        $builder->when($options['store_id'], function (Builder $builder) use ($options) {
            $builder->where('store_id', $options['store_id']);
        });
        $builder->when($options['category_id'], function (Builder $builder) use ($options) {
            $builder->where('category_id', $options['category_id']);
        });
        // $builder->whereExists(function ($query) use ($options) {
        //     $query->selectRaw('1')
        //         ->from('products_tag')
        //         ->whereColumn('products_tag.product_id', 'products.id')
        //         ->when($options['tag_id'], function ($query) use ($options) {
        //             $query->where('products_tag.tag_id', $options['tag_id']);
        //         });
        // });
    }
}
