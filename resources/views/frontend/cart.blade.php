@extends('layouts.app') @section('content')

<style>
    .text-success {
        color: #278c04 !important;
    }

    .text-dangers {
        color: red !important;
    }
</style>

<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Cart</h2>
        <div class="checkout-steps">
            <a href="javascript:void(0)" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Keranjang Belanja</span>
                    <em>Kelola Daftar Barang Anda</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Pengiriman dan Pembayaran</span>
                    <em>Periksa Daftar Barang Anda</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Konfirmasi</span>
                    <em>Tinjau dan Kirim Pesanan Anda</em>
                </span>
            </a>
        </div>
        <div class="shopping-cart">
            @if ($items->count() > 0)
            <div class="cart-table__wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Harga</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img
                                        loading="lazy"
                                        src="{{
                                            asset('uploads/products/thumbnails')
                                        }}/{{ $item->model->image }}"
                                        width="120"
                                        height="120"
                                        alt="{{ $item->name }}"
                                    />
                                </div>
                            </td>
                            <td>
                                <div
                                    class="shopping-cart__product-item__detail"
                                >
                                    <h4>{{ $item->name }}</h4>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">
                                    Rp.{{ number_format($item->price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <form
                                        action="{{ route('cart.qty.update', ['rowId' => $item->rowId]) }}"
                                        method="POST"
                                        class="d-flex align-items-center gap-2"
                                    >
                                        @csrf @method('PUT')

                                        <button
                                            type="submit"
                                            name="action"
                                            value="decrease"
                                            class="btn btn-outline-secondary px-2 py-1"
                                        >
                                            -
                                        </button>

                                        <input
                                            type="number"
                                            name="quantity"
                                            value="{{ $item->qty }}"
                                            min="1"
                                            class="form-control text-center"
                                            style="width: 60px"
                                            readonly
                                        />

                                        <button
                                            type="submit"
                                            name="action"
                                            value="increase"
                                            class="btn btn-outline-secondary px-2 py-1"
                                        >
                                            +
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">
                                    Rp.{{ $item->subtotal() }}
                                </span>
                            </td>
                            <td>
                                <form
                                    action="{{ route('cart.item.remove', ['rowId' => $item->rowId]) }}"
                                    method="POST"
                                >
                                    @csrf @method('DELETE')
                                    <a
                                        href="javascript:void(0)"
                                        class="remove-cart"
                                    >
                                        <svg
                                            width="10"
                                            height="10"
                                            viewBox="0 0 10 10"
                                            fill="#767676"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z"
                                            />
                                            <path
                                                d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z"
                                            />
                                        </svg>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-table-footer">
                    @if (!Session::has('coupon'))
                    <form
                        action="{{ route('cart.coupon.apply') }}"
                        method="POST"
                        class="position-relative bg-body"
                    >
                        @csrf
                        <input
                            class="form-control"
                            type="text"
                            name="coupon_code"
                            placeholder="Masukkan Kode voucher .."
                            value=""
                        />
                        <input
                            class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4"
                            type="submit"
                            value="GUNAKAN VOUCHER"
                        />
                    </form>
                    @else
                    <form
                        action="{{ route('cart.coupon.remove') }}"
                        method="POST"
                        class="position-relative bg-body"
                    >
                        @csrf @method('DELETE')
                        <input
                            class="form-control"
                            type="text"
                            name="coupon_code"
                            placeholder="Coupon Code"
                            value="@if (Session::has('coupon')) {{ Session::get('coupon')['code'] }} Digunakan! @else - @endif"
                        />
                        <input
                            class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4"
                            type="submit"
                            value="HAPUS VOUCHER"
                        />
                    </form>
                    @endif
                    <form action="{{ route('cart.empty') }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-light hapus" type="submit">
                            CLEAR CART
                        </button>
                    </form>
                </div>
                <div>
                    @if (Session::has('success'))
                    <div class="alert alert-success col-5 p-2 mt-3">
                        <p class="text-center">{{ Session::get('success') }}</p>
                    </div>
                    @elseif (Session::has('error'))
                    <div class="alert alert-danger col-5 p-2 mt-3">
                        <p class="text-center">{{ Session::get('error') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>Cart Totals</h3>
                        @if (Session::has('discounts'))
                        <table class="cart-totals">
                            <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>
                                        Rp.
                                        {{ Cart::instance('cart')->subtotal() }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Discount
                                        {{ Session::get('coupon')['code'] }}
                                    </th>
                                    <td>
                                        Rp.
                                        {{ number_format(Session::get('discounts')['discount']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Subtotal after Discount</th>
                                    <td>
                                        Rp.
                                        {{ number_format(Session::get('discounts')['subtotal']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>
                                        Rp.
                                        {{ number_format(Session::get('discounts')['tax']) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>
                                        Rp.
                                        {{ number_format(Session::get('discounts')['total']) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @else @endif
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <a
                                href="{{ route('cart.checkout') }}"
                                class="btn btn-primary btn-checkout"
                                >PROCEED TO CHECKOUT</a
                            >
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12 text-center pt-5 bp-5">
                    <p>belum ada produk di dalam keranjang anda</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-info"
                        >Belanja sekarang !</a
                    >
                </div>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection @push('scripts')
<script>
    $(function () {
        $(".qty_control_increase").on("click", function () {
            $(this).closest("form").submit();
        });

        $(".qty_control_reduce").on("click", function () {
            $(this).closest("form").submit();
        });

        $(".remove-cart").on("click", function () {
            $(this).closest("form").submit();
        });
    });

    $(function () {
        $(".hapus").on("click", function (e) {
            e.preventDefault();
            var form = $(this).closest("form");
            swal({
                title: "Kamu yakin?",
                text: "yakin ingin hapus semua keranjang kamu?",
                type: "warning",
                buttons: ["No", "Yes"],
                confirmButtonColor: "#dc3545",
            }).then(function (result) {
                if (result) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
