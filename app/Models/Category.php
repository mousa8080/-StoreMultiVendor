<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;



/**
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $image
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static Builder<static>|Category active()
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static Builder<static>|Category filter($filter)
 * @method static Builder<static>|Category newModelQuery()
 * @method static Builder<static>|Category newQuery()
 * @method static Builder<static>|Category onlyTrashed()
 * @method static Builder<static>|Category query()
 * @method static Builder<static>|Category status($status)
 * @method static Builder<static>|Category whereCreatedAt($value)
 * @method static Builder<static>|Category whereDeletedAt($value)
 * @method static Builder<static>|Category whereDescription($value)
 * @method static Builder<static>|Category whereId($value)
 * @method static Builder<static>|Category whereImage($value)
 * @method static Builder<static>|Category whereName($value)
 * @method static Builder<static>|Category whereParentId($value)
 * @method static Builder<static>|Category whereSlug($value)
 * @method static Builder<static>|Category whereStatus($value)
 * @method static Builder<static>|Category whereUpdatedAt($value)
 * @method static Builder<static>|Category withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Category withoutTrashed()
 * @mixin \Eloquent
 */
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
    protected $hidden = [
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $appends = [
        'image_url'
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
    public static function booted()
    {
        static::creating(
            function (Category $category) {
                $category->slug = Str::slug($category->name);
            }
        );
        static::updating(
            function (Category $category) {
                $category->slug = Str::slug($category->name);
            }
        );
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
}
