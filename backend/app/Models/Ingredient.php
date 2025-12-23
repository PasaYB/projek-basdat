<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Supplier;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Material;
use App\Models\Warehouse\MaterialIn;
use App\Models\Warehouse\MaterialOut;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    // protected $table = 'ingredients';

    protected $fillable = [
        'name',
        'quantity',
        'slug',
        'unit_id',
        'category_id',
        'supplier_id',
        'price_per_unit',
    ];

    // public function materialIns()
    // {
    //     return $this->hasMany(MaterialIn::class, 'ingredient_id');
    // }

    // public function materialOuts()
    // {
    //     return $this->hasMany(MaterialOut::class, 'ingredient_id');
    // }

    // public function materials()
    // {
    //     return $this->hasMany(Material::class, 'ingredient_id');
    // }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ingredient) {
            $ingredient->slug = Str::slug($ingredient->name, '-');
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
