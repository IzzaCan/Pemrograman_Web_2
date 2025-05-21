<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller 
{
    public function index()
    {
        $categories = Categories::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:product_categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);
        // Jika slug tidak diisi, generate otomatis dari name
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = $imagePath;
        }
        Categories::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:product_categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Upload gambar baru dan hapus gambar lama
        if ($request->hasFile('image')) {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
            $imagePath = $request->file('image')->store('categories', ['disk' => 'public']);
            $validated['image'] = $imagePath;
        }


        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);

        if ($category->image) {
        Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
