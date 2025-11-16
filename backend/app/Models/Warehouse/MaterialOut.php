<?php

namespace App\Models\Warehouse;

use App\Models\Employee;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialOut extends Model
{
    /** @use HasFactory<\Database\Factories\\Warehouse\MaterialOutFactory> */
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'quantity',
        'out_date',
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
