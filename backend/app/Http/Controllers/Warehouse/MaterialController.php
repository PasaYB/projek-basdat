<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\StockRecord;
use Illuminate\Http\Request;
use App\Models\AdjustmentDetails;
use App\Models\Warehouse\Material;
use App\Http\Controllers\Controller;
use App\Models\Warehouse\MaterialIn;
use App\Models\Warehouse\MaterialOut;

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

        $stockRecords->each(function ($record) {
            if ($record->type === 'in') {
                $record->detailRecord = MaterialIn::withTrashed()->where('slug', $record->slug)->first();
            } else if ($record->type === 'out') {
                $record->detailRecord = MaterialOut::withTrashed()->where('slug', $record->slug)->first();
            } else if ($record->type === 'adjustment') {
                $record->adjustDetailRecord = AdjustmentDetails::where('stock_record_id', $record->id)->first();
            }
        });

        // dd($stockRecords->toArray());
        
        return view('inventory.materials.stock_records', compact('stockRecords'));
    }
}
