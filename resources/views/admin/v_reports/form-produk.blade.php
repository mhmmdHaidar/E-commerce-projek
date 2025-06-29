@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <h3 class="my-5">Cetak Laporan Produk</h3>
            <form action="{{ route('laporan.produk.export') }}" method="POST">
                @csrf
                <label>Tanggal Awal:</label>
                <input type="date" name="start_date" required>

                <label>Tanggal Akhir:</label>
                <input type="date" name="end_date" required>

                <select name="format">
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                </select>

                <button type="submit" class="tf-button w208">Cetak</button>
            </form>

        </div>
    </div>
@endsection
