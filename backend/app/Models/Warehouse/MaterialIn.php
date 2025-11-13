<?php

namespace App\Models\Warehouse;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialIn extends Model
{
    /** @use HasFactory<\Database\Factories\\Warehouse\MaterialInFactory> */
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'ingredient_id',
        'total_price',
        'quantity',
        'unit',
        'in_date',
        'note'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}
