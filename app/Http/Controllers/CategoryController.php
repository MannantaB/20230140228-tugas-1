<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
// Removed Gate checks so category pages are accessible to authenticated users

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama category wajib diisi.',
            'name.max' => 'Nama category tidak boleh lebih dari 255 karakter.',
        ]);

        Category::create($validated);

        return redirect()->route('category.index')->with('success', 'Category berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama category wajib diisi.',
            'name.max' => 'Nama category tidak boleh lebih dari 255 karakter.',
        ]);

        $category->update($validated);

        return redirect()->route('category.index')->with('success', 'Category berhasil diperbarui.');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category berhasil dihapus.');
    }
}