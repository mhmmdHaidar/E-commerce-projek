<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
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
                    <th>User</th>
                    <th>No Telp</th>
                    <th>Email</th>
                    <th>Tanggal</th>
                    <th>Total pesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name ?? 'N/A' }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>{{ $user->orders->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
