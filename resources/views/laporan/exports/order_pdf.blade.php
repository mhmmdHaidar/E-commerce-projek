<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Order</title>
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
    <h3>Laporan Order</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>No telp</th>
                <th>Status pesanan</th>
                <th>Item</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>
                        @if ($order->status == 'delivered')
                            <span
                                style="background-color: rgb(0, 141, 0); border-radius: 3px; padding: 5px; color: #e2e2e2"">Di
                                kirim</span>
                        @elseif ($order->status == 'canceled')
                            <span
                                style="background-color: rgb(211, 0, 0); border-radius: 3px; padding: 5px; color: #e2e2e2"">Di
                                Batalkan</span>
                        @else
                            <span
                                style="background-color: rgb(99, 99, 99); border-radius: 3px; padding: 5px; color: #e2e2e2">Di
                                pesan</span>
                        @endif
                    </td>
                    <td>{{ $order->orderItems->count() }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
