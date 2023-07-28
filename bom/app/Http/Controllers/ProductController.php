<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('items.materials')->get();

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
        ]);

        Product::create(['name' => $request->name]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'item_name' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        $item = new Item(['name' => $request->item_name]);
        $product->items()->save($item);

        return redirect()->route('products.index')->with('success', 'Item added successfully!');
    }

    public function storeMaterial(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'material_name' => 'required',
            'material_price' => 'required|numeric|min:0',
        ]);

        $item = Item::findOrFail($request->item_id);
        $material = new Material([
            'name' => $request->material_name,
            'price' => $request->material_price,
        ]);
        $item->materials()->save($material);

        return redirect()->route('products.index')->with('success', 'Material added successfully!');
    }
}
