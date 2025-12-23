<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string',
        ]);
        
        Supplier::create($request->all());
        
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dibuat.');
    }

    public function show(Supplier $supplier)
    {
        // $supplier = Supplier::findOrFail(Supplier $supplier);
        
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        // $supplier = Supplier::findOrFail(Supplier $supplier);
        
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name,' . $supplier->id,
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string',
        ]);
        
        $supplier->update($request->all());
        
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        if (Ingredient::where('supplier_id', $supplier->id)->exists()) {
            return redirect()
                ->route('suppliers.index')
                ->with('error', 'Tidak dapat menghapus supplier. Supplier ini masih digunakan oleh beberapa bahan.');
        }
        $supplier->delete();
        
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
