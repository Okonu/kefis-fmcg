<?php

namespace App\Http\Controllers;

use App\Models\StoreProduct;
use Illuminate\Http\Request;

class StoreProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storeProducts = StoreProduct::all();

        return response()->json($storeProducts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'inventory' => 'required|integer|min:0',
        ]);

        $storeProduct = StoreProduct::create($request->all());

        return response()->json(['message' => 'Store product created successfully', 'store_product' => $storeProduct], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StoreProduct $storeProduct)
    {
        return response()->json($storeProduct);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreProduct $storeProduct)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'inventory' => 'required|integer|min:0',
        ]);

        $storeProduct->update($request->all());

        return response()->json(['message' => 'Store product updated successfully', 'store_product' => $storeProduct]);
    }

    public function reduceInventory(StoreProduct $storeProduct, Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->quantity;

        if ($quantity > $storeProduct->inventory) {
            return response()->json(['message' => 'Insufficient inventory'], 422);
        }

        $storeProduct->inventory -= $quantity;
        $storeProduct->save();

        if ($storeProduct->inventory <= 10) {
            $storeProduct->inventory += 10;

            $storeProduct->save();
        }

        return response()->json(['message' => 'Inventory reduced successfully', 'store_product' => $storeProduct]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreProduct $storeProduct)
    {
        $storeProduct->delete();

        return response()->json(['message' => 'Store product deleted successfully']);
    }
}
