<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\Warehouse\Material;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\MaterialIn;

class MaterialInController extends Controller
{
    public function index()
    {
        $material_ins = MaterialIn::with('ingredient')->get();

        // dd($material_ins);
        
        return view('distribution.material_ins.index', compact('material_ins'));
    }

    public function create()
    {
        $ingredients = Ingredient::with('supplier')->get();

        // dd($ingredients);
        return view('distribution.material_ins.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|min:1',
            'in_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        // dd($validated);

        $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

        $validated['supplier_id'] = $ingredient->supplier_id;
        $validated['unit'] = $ingredient->unit;
        $validated['total_price'] = $ingredient->price_per_unit * $validated['quantity'];

        // simpan data bahan masuk
        DB::transaction(function () use ($validated) {
            $in = MaterialIn::create($validated);

            // cari bahan di gudang, kalau belum ada buat baru
            $material = Material::firstOrNew([
                'ingredient_id' => $in->ingredient_id,
            ]);

            // tambahkan stoknya
            $material->ingredient_id = $in->ingredient->id;
            $material->quantity = ($material->quantity ?? 0) + $in->quantity;
            $material->category_id = $in->ingredient->category_id;
            $material->unit = $in->unit;
            $material->status = $material->quantity > 0 ? 'available' : 'unavailable';
            $material->expired_at = '2025-12-31';
            $material->save();
        });

        return redirect()->route('material_ins.index')->with('success', 'Material in record created successfully.');

    }

    public function show($id)
    {
        $material_in = MaterialIn::findOrFail($id);
        
        return view('distribution.material_ins.show', compact('material_in'));
    }

    public function edit($id)
    {
        $ingredients = Ingredient::with('supplier')->get();
        $material_in = MaterialIn::findOrFail($id);
        
        return view('distribution.material_ins.edit', compact('material_in', 'ingredients'));
    }

    public function update(Request $request, $id)
    {
        $in = MaterialIn::findOrFail($id);
        
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|min:1',
            'in_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        // $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

        // $validated['supplier_id'] = $ingredient->supplier_id;
        // $validated['unit'] = $ingredient->unit;
        // $validated['total_price'] = $ingredient->price_per_unit * $validated['quantity'];

        // $material_in->update($validated);
        
        DB::transaction(function () use ($in, $validated) {
            // hitung selisih jumlah lama dan baru
            $oldQuantity = $in->quantity;
            $diff = $validated['quantity'] - $oldQuantity;

            // ambil data ingredient (supplier_id, price_per_unit, unit)
            $ingredient = Ingredient::findOrFail($validated['ingredient_id']);
            $validated['supplier_id'] = $ingredient->supplier_id;
            $validated['unit'] = $ingredient->unit;
            $validated['total_price'] = $ingredient->price_per_unit * $validated['quantity'];

            // update data bahan masuk
            $in->update($validated);

            // update stok di gudang
            $material = Material::firstOrNew([
                'ingredient_id' => $in->ingredient_id,
            ]);

            $material->quantity = ($material->quantity ?? 0) + $diff;
            $material->status = $material->quantity > 0 ? 'available' : 'unavailable';
            $material->expired_at = $validated['expired_at'] ?? $material->expired_at;
            $material->save();
        });
        return redirect()->route('material_ins.index')->with('success', 'Material In updated successfully.');
    }
    
    public function destroy($id)
    {
        $material_in = MaterialIn::findOrFail($id);

        DB::transaction(function () use ($material_in) {
            // kurangi stok di gudang
            $material = Material::where('ingredient_id', $material_in->ingredient_id)->first();

            if ($material) {
                $material->quantity -= $material_in->quantity;

                if ($material->quantity <= 0) {
                    $material->quantity = 0;
                    $material->status = 'unavailable';
                }

                $material->save();
            }

            // hapus data bahan masuk
            $material_in->delete();
        });        
        return redirect()->route('material_ins.index')->with('success', 'Material In deleted successfully.');
    }
}
