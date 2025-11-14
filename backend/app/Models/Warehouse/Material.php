<?php

namespace App\Models\Warehouse;

use App\Models\Ingredient;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\\Warehouse\MaterialFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'ingredient_id',
        'quantity',
        'unit',
        'status',
        'expired_at'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}
