<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'slug'
    ];

    // public function ingredients()
    // {
    //     return $this->hasMany(Ingredient::class, 'supplier_id');
    // }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            $supplier->slug = Str::slug($supplier->name, '-');
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
