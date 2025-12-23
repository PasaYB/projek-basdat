<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return view('inventory.units.index',[
            'units' => Unit::all(),
        ]);
    }

    public function create()
    {
        return view('inventory.units.create', [
            'units' => Unit::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:units,code|max:10',
            'name' => 'required|max:255',
        ]);

        Unit::create($validated);

        return redirect()->route('units.index')->with('success', 'Unit created successfully.');
    }

    public function edit(Unit $unit)
    {
        // $unit = Unit::findOrFail($id);

        return view('inventory.units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|unique:units,code,' . $unit->id . '|max:10',
            'name' => 'required|max:255',
        ]);

        $unit->update($validated);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);

        if (Ingredient::where('unit_id', $unit->id)->exists()) {
            return redirect()
                ->route('units.index')
                ->with('error', 'Tidak dapat menghapus satuan. Satuan ini masih digunakan oleh beberapa bahan.');
        }
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}