<?php

namespace App\Models\Warehouse;

use App\Models\Employee;
use App\Models\Ingredient;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialOut extends Model
{
    /** @use HasFactory<\Database\Factories\\Warehouse\MaterialOutFactory> */
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'quantity',
        'slug',
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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($material_out) {
            $material_out->slug = Str::slug(uniqid());
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
