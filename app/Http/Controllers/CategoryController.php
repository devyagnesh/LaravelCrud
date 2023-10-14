<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewCategoryPage()
    {
        return view('addCategory');
    }

    public function createCategory(Request $request)
    {
        // Validate the form data
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
            'category_status' => 'required|in:active,inactive',
        ]);

        // Create a new category instance
        $category = new Category();
        $category->name = $request->input('category_name');
        $category->description = $request->input('category_description');
        $category->status = $request->input('category_status');

        // Save the category to the database
        $category->save();

        // Redirect to a success page or back to the form
        return redirect()->route('createCategory')->with('success', 'Category created successfully');
    }
}
