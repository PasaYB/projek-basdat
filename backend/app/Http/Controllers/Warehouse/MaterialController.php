<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\StockRecord;
use Illuminate\Http\Request;
use App\Models\Warehouse\Material;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        // dd($materials->toArray());
        return view('inventory.materials.index', compact('materials'));
    }

    public function stockRecords($id)
    {
        $stockRecords = StockRecord::with('material', 'material.ingredient')->where('material_id', $id)->get();

        // dd($stockRecords->toArray());

        return view('inventory.materials.stock_records', compact('stockRecords'));
    }
}
