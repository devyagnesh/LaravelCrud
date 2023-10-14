<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $products = Product::select('products.*', 'categories.status as category_status', 'categories.name as category_name', 'categories.description as category_description')
            ->leftJoin('categories', 'products.cateid', '=', 'categories.id')
            ->get()
            ->toArray();
        
        return view('dashboard', compact('products'));
    }
}
