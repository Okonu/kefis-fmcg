<?php

namespace App\Http\Controllers;

use App\Events\InventoryChangeEvent;
use App\Models\FulfilledOrder;
use App\Models\Product;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('fulfilledOrders')->get();

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reduceInventory(Request $request, Product $product)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|min:1|max:'.$product->inventory,
        ]);

        $quantityToReduce = $request->input('quantity');
        $product->inventory -= $quantityToReduce;
        $product->save();

        event(new InventoryChangeEvent($product, $quantityToReduce));

        $product->refresh();

        return response()->json([
            'message' => 'Inventory reduced successfully',
            'product' => $product,
        ]);
    }

    public function dispatchProduct($product_id)
    {
        $product = Product::findOrFail($product_id);

        StoreProduct::create([
            'name' => $product->name,
            'inventory' => $product->inventory,
        ]);

        $fulfilledOrder = new FulfilledOrder([
            'product_id' => $product->id,
            'status' => 'fulfilled',
            'order_number' => str_pad(FulfilledOrder::count() + 1, 6, '0', STR_PAD_LEFT),
        ]);

        $fulfilledOrder->save();

        return response()->json(['message' => 'Product dispatched successfully']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
    }
}
