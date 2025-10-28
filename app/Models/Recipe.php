<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'stok',
        'slug',
        'thumbnail',
        'about',
        'price',
        'mn_hd_nasi',
        'mn_hd_utama',
        'mn_hd_pelengkap',
        'mn_hd_sayur',
        'mn_hd_minuman',
        'mn_hd_penutup',
        'category_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name ?? 'Uncategorized';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(RecipePhoto::class);
    }

    // public function tutorials(): HasMany
    // {
    //     return $this->hasMany(RecipeTutorial::class, 'recipe_id');
    // }

    public function recipeIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class, 'recipe_id');
    }
}
