<?php

namespace App\Models\Warehouse;

use App\Models\Employee;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialIn extends Model
{
    /** @use HasFactory<\Database\Factories\\Warehouse\MaterialInFactory> */
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'total_price',
        'quantity',
        'in_date',
        'note',
        'created_by'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}
