<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <br>
    <h1 style="text-align: center;">Product Listing</h1><br>
    <a href="/dashboard" class="btn btn-primary">BACK</a>
    <a href="/createProductForm" class="btn btn-primary">Add Product</a><br><br>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        
        <tbody>
            @if(count($products))
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->amount }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('public/Image/' . $product->image) }}" alt="Product Image" width="100">
                        @else
                            No image available
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        @else
            "No Products available"
        @endif
    </table>
</body>
</html>
