<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);
        
        Category::create($request->all());
        
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        
        return view('inventory.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
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
        
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
