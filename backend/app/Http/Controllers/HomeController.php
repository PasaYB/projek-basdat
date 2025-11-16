<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Material;

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
        return view('home', [
            'categories' => Category::all(),
            'employees' => Employee::all(),
            'materials' => Material::all(),
            'suppliers' => Supplier::all(),
        ]);

    }
}
