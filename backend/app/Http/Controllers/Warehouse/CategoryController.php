<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\Ingredient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Warehouse\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return view('inventory.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('inventory.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);
        
        Category::create($validated);
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function show(Category $category)
    {
        // $category = Category::findOrFail($id);

        // dd($category->toArray());
        
        return view('inventory.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        // $category = Category::findOrFail($id);
        
        return view('inventory.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);
        
        $category->update($request->all());
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        if (Ingredient::where('category_id', $category->id)->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Tidak dapat menghapus kategori. Kategori ini masih digunakan oleh beberapa bahan.');
        }
        
        $category->delete();
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
