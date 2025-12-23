<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Supplier;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\MaterialIn;

class IngredientController extends Controller
{
    public function index()
    {
        return view('inventory.ingredients.index',[
            'ingredients' => Ingredient::all(),
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        return view('inventory.ingredients.create', [
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
            'units' => Unit::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ingredients,name',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'unit_id' => 'required|exists:units,id',
            'price_per_unit' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Ingredient::create($request->all());

        return redirect()->route('ingredients.index')->with('success', 'Bahan berhasil dibuat.');
    }

    public function show(Ingredient $ingredient)
    {
        // $ingredient = Ingredient::findOrFail(Ingredient $ingredient);
        
        return view('inventory.ingredients.show', compact('ingredient'));
    }

    public function edit(Ingredient $ingredient)
    {        
        return view('inventory.ingredients.edit', [
            // 'ingredient' => Ingredient::findOrFail(Ingredient $ingredient),
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
            'units' => Unit::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ingredients,name,' . $id,
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'unit_id' => 'required|exists:units,id',
            'price_per_unit' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());

        return redirect()->route('ingredients.index')->with('success', 'Bahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        
        if (MaterialIn::where('ingredient_id', $ingredient->id)->exists()) {
            return redirect()
            ->route('ingredients.index')
            ->with('error', 'Tidak dapat menghapus Bahan. Bahan ini masih digunakan oleh beberapa data lain.');
        }
        
        $ingredient->delete();
        
        return redirect()->route('ingredients.index')->with('success', 'Bahan berhasil dihapus.');
    }
}