<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Ingredient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Warehouse\Material;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\MaterialIn;
use Illuminate\Support\Facades\Auth;
use App\Models\Warehouse\MaterialOut;

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
        $ingredients = Ingredient::with(['supplier', 'unit'])->get();

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
            // 'created_by' => Auth::id()
        ]);

        $validated['created_by'] = auth()->id();

        // dd($validated);

        $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

        $validated['total_price'] = $ingredient->price_per_unit * $validated['quantity'];

        // transaction
        DB::transaction(function () use ($validated) {
            $in = MaterialIn::create($validated);

            // find or make new
            $material = Material::firstOrNew([
                'ingredient_id' => $in->ingredient_id,
            ]);

            // add stock to material warehouse
            $material->last_updated_by = $validated['created_by'];
            $material->ingredient_id = $in->ingredient->id;
            $material->quantity = ($material->quantity ?? 0) + $in->quantity;
            $material->status = $material->quantity > 0 ? 'available' : 'unavailable';
            $material->save();
        });

        $material = Material::where('ingredient_id', $validated['ingredient_id'])->first();

        // log stock record
        DB::table('stock_records')->insert([
            'material_id' => $material->id,
            'stock' => $material->quantity,
            'recorded_at' => $validated['in_date'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('material_ins.index')->with('success', 'Data Bahan Masuk berhasil disimpan.');

    }

    public function show(MaterialIn $material_in)
    {
        // $material_in = MaterialIn::findOrFail(MaterialIn $material_in);
        
        return view('distribution.material_ins.show', compact('material_in'));
    }

    public function edit(MaterialIn $material_in)
    {
        $ingredients = Ingredient::with('supplier', 'unit')->get();
        // $material_in = MaterialIn::findOrFail(MaterialIn $material_in);
        
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

        $validated['created_by'] = auth()->id();
        
        DB::transaction(function () use ($in, $validated) {
            // compare nett
            $oldQuantity = $in->quantity;
            $diff = $validated['quantity'] - $oldQuantity;

            $ingredient = Ingredient::findOrFail($validated['ingredient_id']);
            $validated['total_price'] = $ingredient->price_per_unit * $validated['quantity'];

            $in->update($validated);

            // stock update
            $material = Material::firstOrNew([
                'ingredient_id' => $in->ingredient_id,
            ]);
            
            $material->last_updated_by = $validated['created_by'];
            $material->quantity = ($material->quantity ?? 0) + $diff;
            $material->status = $material->quantity > 0 ? 'available' : 'unavailable';
            $material->save();
        });

        $material = Material::where('ingredient_id', $validated['ingredient_id'])->first();

        // log stock record
        DB::table('stock_records')->insert([
            'material_id' => $material->id,
            'stock' => $material->quantity,
            'recorded_at' => $validated['in_date'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('material_ins.index')->with('success', 'Data Bahan Masuk berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $material_in = MaterialIn::findOrFail($id);

        if (MaterialOut::where('ingredient_id', $material_in->ingredient_id)->exists()) {
            return redirect()
                ->route('material_ins.index')
                ->with('error', 'Tidak dapat menghapus data bahan masuk. Bahan ini sudah memiliki riwayat pengeluaran.');
        }

        $newQuantity = null;

        DB::transaction(function () use ($material_in, &$newQuantity) {
            $material = Material::where('ingredient_id', $material_in->ingredient_id)
                ->lockForUpdate()
                ->first();

            if ($material) {
                $newQuantity = $material->quantity - $material_in->quantity;

                if ($newQuantity <= 0) {
                    $newQuantity = 0;
                    $material->status = 'unavailable';
                }

                $material->quantity = $newQuantity;
                $material->save();
            }

            $material_in->delete();
        });  

        $material = Material::where('ingredient_id', $material_in->ingredient_id)->first();

        // log stock record
        DB::table('stock_records')->insert([
            'material_id' => $material->id,
            'stock' => $newQuantity,
            'recorded_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('material_ins.index')->with('success', 'Data Bahan Masuk berhasil dihapus.');
    }
}
