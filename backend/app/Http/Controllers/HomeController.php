<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Supplier;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Material;
use App\Models\Warehouse\MaterialIn;
use App\Models\Warehouse\MaterialOut;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::withCount('ingredients')->get();
        
        return view('home', [
            'categories' => $categories,
            'employees' => Employee::all(),
            'materials' => Material::with('ingredient')->get(),
            'suppliers' => Supplier::all(),
            'recentMaterialIns' => MaterialIn::with(['ingredient'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'recentMaterialOuts' => MaterialOut::with(['ingredient'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
        ]);

    }
}
