<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        /* Gaya CSS untuk laporan */
        /* Misalnya, Anda dapat menyesuaikan gaya sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Invoice</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ 'IDR '.$item['price'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ 'IDR '.$item['quantity'] * $item['price'] }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">Subtotal</td>
                <td>{{ 'IDR '.$total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
