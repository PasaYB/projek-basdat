<?php

namespace App\Models;

use App\Models\Ingredient;
use App\Models\Warehouse\Material;
use Illuminate\Database\Eloquent\Model;

class StockRecord extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
