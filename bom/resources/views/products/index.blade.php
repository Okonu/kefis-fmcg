<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="post" action="{{ route('products.store') }}">
        @csrf
        <label>Product Name:</label>
        <input type="text" name="name" required>
        <button type="submit">Add Product</button>
    </form>

    <hr>

    <h2>Product List</h2>
    <ul>
        @foreach($products as $product)
            <li>
                <strong>{{ $product->name }}</strong>

                <h3>Items</h3>
                <ul>
                    @foreach($product->items as $item)
                        <li>
                            {{ $item->name }}
                            @if($item->materials->count() > 0)
                                <h4>Materials</h4>
                                <ul>
                                    @foreach($item->materials as $material)
                                        <li>{{ $material->name }} - Ksh {{ number_format($material->price, 2) }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <form method="post" action="{{ route('materials.store') }}">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <label>Add Material:</label>
                                <input type="text" name="material_name" required>
                                <label>Price:</label>
                                <input type="number" name="material_price" step="0.01" required>
                                <button type="submit">Add</button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <form method="post" action="{{ route('items.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label>Add Item:</label>
                    <input type="text" name="item_name" required>
                    <button type="submit">Add</button>
                </form>
                
                <strong>Total Cost:</strong> Ksh {{ number_format($product->getTotalCost(), 2) }}
            </li>
        @endforeach
    </ul>
</body>
</html>
