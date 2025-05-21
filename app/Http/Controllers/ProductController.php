<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')->orderBy('id')->get();
        return view('dashboard.products.index', compact('products'));
    }

    // Form tambah produk
    public function create()
    {
        $categories = Categories::all();
        return view('dashboard.products.create', compact('categories'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'slug'                 => 'nullable|string|max:255|unique:products,slug',
            'description'          => 'nullable|string',
            'price'                => 'required|numeric|min:0',
            'sku'                  => 'required|string|max:100|unique:products,sku',
            'stock'                => 'required|integer|min:0',
            'product_category_id'  => 'required|exists:product_categories,id',
            'image'                => 'nullable|image|max:2048',
            'is_active'            => 'required|boolean',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', ['disk' => 'public']);
            $validated['image_url'] = $imagePath;
        }

        // Tambahkan slug
        $validated['slug'] = Str::slug($validated['name']);


        // Simpan produk
        $product = Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Form edit produk
    public function edit(Product $product)
    {
        $categories = Categories::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    // Memperbarui produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'slug'                 => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'description'          => 'nullable|string',
            'price'                => 'required|numeric|min:0',
            'sku'                  => 'required|string|max:100|unique:products,sku,' . $product->id,
            'stock'                => 'required|integer|min:0',
            'product_category_id'  => 'required|exists:product_categories,id',
            'image'                => 'nullable|image|max:2048',
            'is_active'            => 'required|boolean',
        ]);

        // Upload gambar baru dan hapus gambar lama
        if ($request->hasFile('image')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $imagePath = $request->file('image')->store('products', ['disk' => 'public']);
            $validated['image_url'] = $imagePath;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Simpan perubahan
        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}