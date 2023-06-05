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
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->paginate(20);

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
                $fileName = $image->getClientOriginalName();
                $filePath = $image->storeAs('products', $fileName, 'public');
                $productData['images'][] = $filePath;
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
        $productData['images'] = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $index = array_search($image, $request->file('images'));
                if (isset($product->images[$index])) {
                    Storage::delete('public/' . $product->images[$index]);
                }

                $fileName = $image->getClientOriginalName();
                $filePath = $image->storeAs('products', $fileName, 'public');
                $productData['images'][] = $filePath;
            }
        }

        if ($request->has('remove_images')) {
            $removeImages = $request->input('remove_images');

            // hapus dri storage trs update $productData
            foreach ($removeImages as $removeImage) {
                Storage::delete('public/' . $removeImage);
                $productData['images'] = array_diff($productData['images'], [$removeImage]);
            }
        }

        $product->update($productData);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        foreach ($product->images as $image) {
            Storage::delete('public/' . $image);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function showProductsByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products()->paginate(20);

        return view('products.category', compact('category', 'products'));
    }

    public function showProductsByAgency($agencyId)
    {
        $agency = Agency::findOrFail($agencyId);

        $products = $agency->products()->paginate(20);

        return view('products.agency', compact('agency', 'products'));
    }

    public function showProducts(Product $product)
    {
        $products = Product::where('agency_id', $product->agency_id)
            ->where('id', '!=', $product->id)
            ->limit(5)
            ->get();

        return view('products.product-details', compact('product', 'products'));
    }

    public function search(Request $request)
    {

        $searchTerm = $request->input('q');
        $products = Product::where('name', 'LIKE', "%{$searchTerm}%")->paginate(20);


        return view('products.search', ['products' => $products, 'searchTerm' => $searchTerm]);
    }

    public function showOnSaleProducts()
    {
        $products = Product::whereNotNull('discounted_price')->paginate(20);

        return view('products.deals', compact('products'));
    }
}
