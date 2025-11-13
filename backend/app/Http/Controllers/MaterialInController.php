<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Ingredient;
use Illuminate\Http\Request;
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

        $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

        $validated['supplier_id'] = $ingredient->supplier_id;
        $validated['unit'] = $ingredient->unit;
        $validated['total_price'] = $ingredient->price_per_unit * $validated['quantity'];

        MaterialIn::create($validated);

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
        $material_in = MaterialIn::findOrFail($id);
        
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|min:1',
            'in_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $ingredient = Ingredient::findOrFail($validated['ingredient_id']);

        $validated['supplier_id'] = $ingredient->supplier_id;
        $validated['unit'] = $ingredient->unit;
        $validated['total_price'] = $ingredient->price_per_unit * $validated['quantity'];

        $material_in->update($validated);
        
        return redirect()->route('material_ins.index')->with('success', 'Material In updated successfully.');
    }
    
    public function destroy($id)
    {
        $material_in = MaterialIn::findOrFail($id);
        $material_in->delete();
        
        return redirect()->route('material_ins.index')->with('success', 'Material In deleted successfully.');
    }
}
