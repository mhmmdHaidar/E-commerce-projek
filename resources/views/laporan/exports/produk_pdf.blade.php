<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Laporan Produk</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h3>Laporan User</h3>
    <p>
        <strong>Periode:</strong>
        {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} s/d
        {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Kode</th>
                <th>Kategori</th>
                <th>Brand</th>
                <th>Stok</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $produk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $produk->name }}</td>
                    <td>Rp. {{ number_format($produk->sale_price) }}</td>
                    <td>{{ $produk->SKU }}</td>
                    <td>{{ $produk->category->name }}</td>
                    <td>{{ $produk->brand->name }}</td>
                    <td>{{ $produk->quantity }}</td>
                    <td>{{ $produk->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
