<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    // Methods for show, edit, update, and destroy can be added here as needed
}
