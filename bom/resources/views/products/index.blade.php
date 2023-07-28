<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        body {
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .btn {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .product-card {
            margin: 10px 0;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }

        .product-card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .item-card {
            margin: 10px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }

        .item-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .materials-list {
            padding-left: 20px;
            border-left: 1px solid #ccc;
        }

        .clickable {
            cursor: pointer;
            color: #007bff;
            text-decoration: none;
        }

        .clickable:hover {
            text-decoration: underline;
        }

        .rotate-icon {
            transform-origin: 50% 50%;
            transition: transform 0.3s ease;
        }

        .open .rotate-icon {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-box"></i>Finished Products</h1>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <form method="post" action="{{ route('products.store') }}">
            @csrf
            <label>Product Name:</label>
            <input type="text" name="name" required>
            <button type="submit" class="btn">Add Product <i class="fas fa-plus-circle"></i></button>
        </form>

        <hr>

        <h2>Product List</h2>
        <ul>
            @foreach($products as $product)
                <li class="product-card">
                    <strong class="clickable"><i class="fas fa-box"></i> {{ $product->name }}</strong>

                    <h3 class="clickable">Items <i class="fas fa-caret-down rotate-icon"></i></h3>
                    <ul class="toggle-list">
                        @foreach($product->items as $item)
                            <li class="item-card">
                                <span class="clickable"><i class="fas fa-cube"></i> {{ $item->name }}</span>
                                <ul class="materials-list toggle-list">
                                    @foreach($item->materials as $material)
                                        <li><i class="fas fa-circle"></i> {{ $material->name }} - Ksh {{ number_format($material->price, 2) }}</li>
                                    @endforeach
                                </ul>

                                <form method="post" action="{{ route('materials.store') }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <label>Add Material:</label>
                                    <input type="text" name="material_name" required>
                                    <label>Price:</label>
                                    <input type="number" name="material_price" step="0.01" required>
                                    <button type="submit" class="btn">Add <i class="fas fa-plus-circle"></i></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                    <form method="post" action="{{ route('items.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <label>Add Item:</label>
                        <input type="text" name="item_name" required>
                        <button type="submit" class="btn">Add <i class="fas fa-plus-circle"></i></button>
                    </form>
                    
                    <strong>Total Cost:</strong> Ksh {{ number_format($product->getTotalCost(), 2) }}
                </li>
            @endforeach
        </ul>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
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