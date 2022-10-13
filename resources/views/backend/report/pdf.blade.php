<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table >
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Product</th>
                <th>Begin Stock</th>
                <th>Total Stock</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($inventory_product as $inventory_products)
            <tr style="text-align: center;">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $inventory_products->created_at}}</td>
                <td>{{ $inventory_products->product->name ?? ''}}</td>
                <td>{{ $inventory_products->begin_stock ?? ''}}</td>
                <td>{{ $inventory_products->total_stock ?? ''}}</td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>