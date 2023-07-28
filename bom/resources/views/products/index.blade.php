<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            margin-bottom: 10px;
        }

        button {
            padding: 5px 10px;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            margin-bottom: 15px;
        }

        ul li ul {
            list-style: none;
            padding-left: 0;
        }

        ul li ul li {
            margin-bottom: 5px;
        }

        strong {
            display: block;
            margin-bottom: 5px;
        }

        h2, h3, h4 {
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .toggle-list {
            display: none;
        }

        .open .toggle-list {
            display: block;
        }

        .clickable {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
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
            <li class="clickable">
                <strong>{{ $product->name }}</strong>

                <h3 class="clickable">Items</h3>
                <ul class="toggle-list">
                    @foreach($product->items as $item)
                        <li class="clickable">
                            {{ $item->name }}
                            @if($item->materials->count() > 0)
                                <h4 class="clickable">Materials</h4>
                                <ul class="toggle-list">
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

    <script>
        const clickableElements = document.querySelectorAll('.clickable');

        clickableElements.forEach((element) => {
            element.addEventListener('click', () => {
                element.parentNode.classList.toggle('open');
            });
        });
    </script>
</body>
</html>