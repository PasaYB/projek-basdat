<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse\Material;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouse\MaterialIn;
use App\Models\Warehouse\MaterialOut;

class MaterialOutController extends Controller
{
    public function index()
    {
        $material_outs = MaterialOut::with('ingredient')->get();
        
        return view('distribution.material_outs.index', compact('material_outs'));
    }

    public function create()
    {
        $materials = Material::with(['ingredient.unit'])
            ->where('quantity', '>', 0)
            ->get();

        // Add latest in_date to each material
        $materials->each(function($material) {
            $latestMaterialIn = MaterialIn::where('ingredient_id', $material->ingredient_id)
                ->orderBy('in_date', 'desc')
                ->first();
            $material->latest_in_date = $latestMaterialIn ? $latestMaterialIn->in_date : null;
        });

        // dd($materials);
        return view('distribution.material_outs.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|min:1',
            'out_date' => 'required|date',
            'note' => 'nullable|string',
            // 'created_by' => Auth()->id(),
        ]);

        $validated['created_by'] = auth()->id();

        $material = Material::where('ingredient_id', $validated['ingredient_id'])->first();

        if ($material->quantity < $validated['quantity']) {
            return back()->withErrors([
                'quantity' => 'Stok tidak mencukupi. Stok tersedia: ' . $material->quantity . ' ' . $material->unit
            ])->withInput();
        }

        // Validate out_date is greater than in_date
        $materialIn = MaterialIn::where('ingredient_id', $validated['ingredient_id'])
            ->orderBy('in_date', 'desc')
            ->first();

        if ($materialIn && $validated['out_date'] < $materialIn->in_date) {
            return back()->withErrors([
                'out_date' => 'Tanggal keluar harus lebih besar dari tanggal masuk (' . \Carbon\Carbon::parse($materialIn->in_date)->format('d/m/Y') . ')'
            ])->withInput();
        }

        $out = MaterialOut::create($validated);

        // dd($out->toArray());
        $material->quantity -= $validated['quantity'];

        if ($material->quantity <= 0) {
            $material->status = 'unavailable';
        }

        $material->save();

        // log stock record
        DB::table('stock_records')->insert([
            'material_id' => $material->id,
            'type' => 'out',
            'slug' => $out->slug,
            'stock' => $material->quantity,
            'recorded_at' => $validated['out_date'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('material_outs.index')->with('success', 'Data Bahan Keluar berhasil disimpan.');
    }

    public function show($slug)
    {
        $material_out = MaterialOut::withTrashed()->where('slug', $slug)->firstOrFail();
        
        return view('distribution.material_outs.show', compact('material_out'));
    }

    public function edit(MaterialOut $material_out)
    {        
        $materials = Material::with(['ingredient.unit'])
            ->where('quantity', '>', 0)
            ->orWhere('ingredient_id', $material_out->ingredient_id)
            ->get();

        // Add latest in_date to each material
        $materials->each(function($material) {
            $latestMaterialIn = MaterialIn::where('ingredient_id', $material->ingredient_id)
                ->orderBy('in_date', 'desc')
                ->first();
            $material->latest_in_date = $latestMaterialIn ? $latestMaterialIn->in_date : null;
        });
        
        return view('distribution.material_outs.edit', compact('material_out', 'materials'));
    }

    public function update(Request $request, $id)
    {
        $material_out = MaterialOut::findOrFail($id);

        $oldQty = $material_out->quantity;
        
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|min:1',
            'out_date' => 'required|date',
            'note' => 'nullable|string',
            // 'created_by' => Auth()->id(),
        ]);

        $validated['created_by'] = auth()->id();

        // Restore the old quantity back to material stock
        $oldMaterial = Material::where('ingredient_id', $material_out->ingredient_id)->first();
        if ($oldMaterial) {
            $oldMaterial->quantity += $material_out->quantity;
            if ($oldMaterial->quantity > 0) {
                $oldMaterial->status = 'available';
            }
            $oldMaterial->save();
        }

        // Get the new material
        $newMaterial = Material::where('ingredient_id', $validated['ingredient_id'])->first();

        // dd($newMaterial->toArray());
        if (!$newMaterial) {
            return back()->withErrors([
                'ingredient_id' => 'Material tidak ditemukan.'
            ])->withInput();
        }

        if ($newMaterial->quantity < $validated['quantity']) {
            return back()->withErrors([
                'quantity' => 'Stok tidak mencukupi. Stok tersedia: ' . $newMaterial->quantity . ' ' . $newMaterial->unit
            ])->withInput();
        }

        // Validate out_date is greater than in_date
        $materialIn = MaterialIn::where('ingredient_id', $validated['ingredient_id'])
            ->orderBy('in_date', 'desc')
            ->first();

        if ($materialIn && $validated['out_date'] < $materialIn->in_date) {
            return back()->withErrors([
                'out_date' => 'Tanggal keluar harus lebih besar dari tanggal masuk (' . \Carbon\Carbon::parse($materialIn->in_date)->format('d/m/Y') . ')'
            ])->withInput();
        }

        $material_out->update($validated);

        // Deduct from new material
        $newMaterial->quantity -= $validated['quantity'];
        if ($newMaterial->quantity <= 0) {
            $newMaterial->status = 'unavailable';
        }
        $newMaterial->save();

        // log stock record
        $stockRecordId = DB::table('stock_records')->insertGetId([
            'material_id' => $newMaterial->id,
            'stock' => $newMaterial->quantity,
            'type' => 'adjustment',
            'slug' => $material_out->slug,
            'recorded_at' => $validated['out_date'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // adjustment stock record
        DB::table('adjustment_details')->insert([
            'stock_record_id' => $stockRecordId,
            'adjustment_type' => 'update',
            'qty_before' => $oldQty,
            'qty_after' => $newMaterial->quantity,
            'adjusted_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('material_outs.index')->with('success', 'Data Bahan Keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $material_out = MaterialOut::findOrFail($id);
        
        $material = Material::where('ingredient_id', $material_out->ingredient_id)->first();

        $oldQty = $material_out->quantity;

        if ($material) {
           $newQty = $material->quantity + $material_out->quantity;
            if ($newQty > 0) {
                $material->status = 'available';
            }
            $material->quantity = $newQty;
            $material->save();
        }

        $material_out->delete();
        
        // log stock record
        $stockRecordId = DB::table('stock_records')->insertGetId([
            'material_id' => $material->id,
            'stock' => $newQty,
            'slug' => $material_out->slug,
            'type' => 'adjustment',
            'recorded_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // adjustment stock record
        DB::table('adjustment_details')->insert([
            'stock_record_id' => $stockRecordId,
            'adjustment_type' => 'delete',
            'qty_before' => 0,
            'qty_after' => $oldQty,
            'adjusted_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('material_outs.index')->with('success', 'Data Bahan Keluar berhasil dihapus.');
    }

}
