<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function showAddProductPage()
    {
        /*
            add category dynamically so we can select it for product
        */
        $categories = Category::all()->toArray();
        return view('addProduct', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_images' => 'required|array|min:1',
            'category' => 'required|exists:categories,id',
            'product_price' => 'required|numeric',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'product_description' => 'required'
        ]);


        $productImages = [];
        foreach ($request->file('product_images') as $image) {
            $path = $image->store('product_images', 'public');
            $productImages[] = $path;
        }
        $mainImage = $request->file('main_image')->store('main_images', 'public');


        $product = new Product();
        $product->name = $request->input('product_name');
        $product->img_gallary = implode(',', $productImages);
        $product->cateid = $request->input('category');
        $product->price = $request->input('product_price');
        $product->main_img = $mainImage;
        $product->description = $request->input('product_description');
        $product->save();

        return redirect()->route('addProduct')->with('success', 'Product added successfully');
    }


    public function editProduct(Request $request, $id)
    {
        $product = Product::find($id)->toArray();
        $categories = Category::all()->toArray();
        return view('editProduct', compact('product', 'categories'));
    }

    public function postEditProduct(Request $request, $id)
    {


        $request->validate([
            'product_name' => 'required',
            'product_images' => 'array', // Allow empty array (no new images required)
            'category' => 'required|exists:categories,id',
            'product_price' => 'required|numeric',
            'main_image' => 'image|mimes:jpeg,png,jpg|max:4096', // Adjust the allowed image formats and file size as needed
            'product_description' => 'required',
        ]);

        // Get the product by ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('editProduct', ['id' => $id])->with('error', 'Product not found');
        }

        // Handle product images update
        if ($request->hasFile('product_images')) {
            // Remove old product images
            $this->deleteOldProductImages($product->img_gallary);

            $productImages = [];
            foreach ($request->file('product_images') as $image) {
                $path = $image->store('product_images', 'public');
                $productImages[] = $path;
            }
            $product->img_gallary = implode(',', $productImages);
        }

        // Handle main image update
        if ($request->hasFile('main_image')) {
            // Remove old main image
            $this->deleteOldMainImage($product->main_img);

            $mainImage = $request->file('main_image')->store('main_images', 'public');
            $product->main_img = $mainImage;
        }

        $product->name = $request->input('product_name');
        $product->cateid = $request->input('category');
        $product->price = $request->input('product_price');
        $product->description = $request->input('product_description');
        $product->save();

        return redirect()->route('editProduct', ['id' => $id])->with('success', 'Product updated successfully');
    }


    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('showDashboard')->with('error', 'Product not found');
        }

        // Remove product images
        $imagePathsArray = explode(',', $product->img_gallary);
        foreach ($imagePathsArray as $path) {
            Storage::disk('public')->delete($path);
        }

        // Delete the main image
        Storage::disk('public')->delete($product->main_img);

        // Delete the product
        $product->delete();

        return redirect()->route('showDashboard')->with('success', 'Product deleted successfully');
    }

    private function deleteOldProductImages($imagePaths)
    {

        $imagePathsArray = explode(',', $imagePaths);
        foreach ($imagePathsArray as $path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function deleteOldMainImage($imagePath)
    {

        Storage::disk('public')->delete($imagePath);
    }
}
