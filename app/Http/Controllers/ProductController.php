<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $agencies = Agency::all();

        return view('admin.products.create', compact('categories',  'agencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'agency_id' => 'required|exists:agencies,id',
            'images' => 'nullable|array|max:7',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productData = $request->except('images');
        $productData['images'] = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $filePath = $image->storeAs('products', $fileName, 'public');
                $productData['images'][] = $filePath;
                $image->storeAs('products', $fileName);
            }
        }

        $product = Product::create($productData);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $agencies = Agency::all();

        return view('admin.products.edit', compact('categories', 'product', 'agencies'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'agency_id' => 'required|exists:agencies,id',
            'images' => 'nullable|array|max:7',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productData = $request->except('images');
        $productData['images'] = $product->images;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $filePath = $image->storeAs('products', $fileName, 'public');
                $productData['images'][] = $filePath;
                $image->storeAs('products', $fileName);
            }
        }

        if ($request->has('remove_images')) {
            $removeImages = $request->input('remove_images');

            // hapus dri storage trs update $productData
            foreach ($removeImages as $removeImage) {
                Storage::delete('public/' . $removeImage);
                $productData['images'] = array_diff($productData['images'], [$removeImage]);
            }

            // reset array index
            $productData['images'] = array_values($productData['images']);
        }

        if ($request->hasFile('edit_images')) {
            $editImages = $request->file('edit_images');

            foreach ($editImages as $index => $editImage) {
                // hapus image lama
                if (isset($removeImages[$index])) {
                    Storage::delete('public/' . $product->images[$index]);
                    unset($productData['images'][$index]);
                }

                // upload image baru
                $path = $editImage->store('products', 'public');
                $productData['images'][$index] = $path;

                // update image di public
                $publicPath = 'public/storage/products/' . basename($path);
                if (Storage::exists($publicPath)) {
                    Storage::delete($publicPath);
                }
                Storage::copy($path, $publicPath);
            }
        }

        $productData['images'] = $productData['images'] ?? [];

        $product->update($productData);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function showProductsByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products()->get();

        return view('products.category', compact('category', 'products'));
    }

    public function showProductsByAgency($agencyId)
    {
        $agency = Agency::findOrFail($agencyId);
        $products = $agency->products()->get();

        return view('products.agency', compact('agency', 'products'));
    }
}
