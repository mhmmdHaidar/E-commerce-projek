@extends('layouts.admin') @section('content')
<style>
    .table-transaction > tbody > tr:nth-of-type(odd) {
        --bs-table-accent-bg: #fff !important;
    }
</style>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Order Details</h3>
            <ul
                class="breadcrumbs flex items-center flex-wrap justify-start gap10"
            >
                <li>
                    <a href="{{ route('admin.index') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Order Details</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <h5>Detail Pesanan</h5>
                </div>
                <a
                    class="tf-button style-1 w208"
                    href="{{ route('admin.orders') }}"
                    >Back</a
                >
            </div>
            <div class="table-responsive">
                @if (Session::has('status'))
                <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>No Pesanan</th>
                        <td>{{ $order->id }}</td>
                        <th>No Telepon</th>
                        <td>{{ $order->phone }}</td>
                        <th>Kode Pos</th>
                        <td>{{ $order->zip }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pemesanan</th>
                        <td>{{ $order->created_at }}</td>
                        <th>Tanggal Di kirim</th>
                        <td>{{ $order->delivered_date }}</td>
                        <th>Tanggal Batal</th>
                        <td>{{ $order->canceled_date }}</td>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <td colspan="5">
                            @if ($order->status == 'delivered')
                            <span class="badge bg-success">Di Kirim</span>
                            @elseif ($order->status == 'cenceled')
                            <span class="badge bg-danger">Di Batalkan</span>
                            @else
                            <span class="badge bg-warning">Di Pesan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <h5>Item Pesanan</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Options</th>
                            <th class="text-center">Return Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                        <tr>
                            <td class="pname">
                                <div class="image">
                                    <img
                                        src="{{
                                            asset('uploads/products/thumbnails')
                                        }}/{{ $item->product->image }}"
                                        alt="{{ $item->product->name }}"
                                        class="image"
                                    />
                                </div>
                                <div class="name">
                                    <a
                                        href="{{ route('shop.product.details', ['product_slug' => $item->product->slug]) }}"
                                        target="_blank"
                                        class="body-title-2"
                                        >{{ $item->product->name }}</a
                                    >
                                </div>
                            </td>
                            <td class="text-center">
                                Rp. {{ number_format($item->price) }}
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">
                                {{ $item->product->SKU }}
                            </td>
                            <td class="text-center">
                                {{ $item->product->category->name }}
                            </td>
                            <td class="text-center">
                                {{ $item->product->brand->name }}
                            </td>
                            <td class="text-center">{{ $item->options }}</td>
                            <td class="text-center">
                                {{ $item->rstatus == 0 ? 'NO' : 'YES' }}
                            </td>
                            <td class="text-center">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
            <div
                class="flex items-center justify-between flex-wrap gap10 wgp-pagination"
            >
                {{ $orderItems->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <div class="wg-box mt-5">
            <h5>Alamat pesanan</h5>
            <div class="my-account__address-item col-md-6">
                <div class="my-account__address-item__detail">
                    <h6>Nama : {{ $order->name }}</h6>
                    <h6>Alamat : {{ $order->address }}</h6>
                    <h6>Kecamatan : {{ $order->state }}</h6>
                    <h6>Kota/Kabupaten :{{ $order->city }}</h6>
                    <h6>Provinsi : {{ $order->landmark }}</h6>
                    <h6>Kode Pos : {{ $order->zip }}</h6>
                    <br />
                    <h6>No telepon : {{ $order->phone }}</h6>
                </div>
            </div>
        </div>

        <div class="wg-box mt-5">
            <h5>Transactions</h5>
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td>Rp. {{ number_format($order->subtotal) }}</td>
                        <th>Pajak</th>
                        <td>Rp. {{ number_format($order->tax) }}</td>
                        <th>Diskon</th>
                        <td>Rp. {{ number_format($order->discount) }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>Rp. {{ number_format($order->total) }}</td>
                        <th>Pembayaran</th>
                        <td>{{ $transaction->mode }}</td>
                        <th>Status</th>
                        <td>
                            @if ($transaction->status == 'approved')
                            <span class="badge bg-success">Di setujui</span>
                            @elseif ($transaction->status == 'declinded')
                            <span class="badge bg-danger">Di Tolak</span>
                            @elseif ($transaction->status == 'refunded')
                            <span class="badge bg-secondary"
                                >Di Kembalikan</span
                            >
                            @else
                            <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="wg-box mt-5">
            <h5>Update status pesanan</h5>
            <table class="table table-striped table-bordered table-transaction">
                <form
                    action="{{ route('admin.order.status.update') }}"
                    method="POST"
                >
                    @csrf @method('PUT')
                    <input
                        type="hidden"
                        name="order_id"
                        value="{{ $order->id }}"
                    />
                    <div class="row">
                        <div class="col-md-3">
                            <div class="select">
                                <select name="order_status" id="order_status">
                                    <option value="ordered" {{ $order->
                                        status == 'ordered' ? 'selected' : ''
                                        }}>Ordered
                                    </option>
                                    <option value="delivered" {{ $order->
                                        status == 'delivered' ? 'selected' : ''
                                        }}> delivered
                                    </option>
                                    <option value="canceled" {{ $order->
                                        status == 'canceled' ? 'selected' : ''
                                        }}> canceled
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button
                                type="submit"
                                class="btn btn-primary tf-button w208"
                            >
                                Update Status
                            </button>
                        </div>
                    </div>
                </form>
            </table>
        </div>
    </div>
</div>
@endsection
