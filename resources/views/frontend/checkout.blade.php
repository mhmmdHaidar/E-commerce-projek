@extends('layouts/app') @section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Shipping and Checkout</h2>
        <div class="checkout-steps">
            <a href="javascript:void(0)" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Keranjang Belanja</span>
                    <em>Kelola Daftar Barang Anda</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item active">
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
        <form
            name="checkout-form"
            class="needs-validation"
            novalidate
            action="{{ route('cart.place.an.order') }}"
            method="POST"
        >
            @csrf
            <div class="checkout-form">
                <div class="billing-info__wrapper">
                    <div class="row">
                        <div class="col-6">
                            <h4>Detail order</h4>
                        </div>
                        <div class="col-6"></div>
                    </div>

                    @if ($address)
                    <div class="container mt-4">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div
                                        class="card-header bg-primary text-white"
                                    >
                                        <h5 class="mb-0">Detail Pengiriman</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            <strong>Nama:</strong>
                                            {{ $address->name }}
                                        </p>
                                        <p>
                                            <strong
                                                >Alamat lengkap / No Rumah /
                                                Nama jln:</strong
                                            >
                                            {{ $address->address }}
                                        </p>
                                        <p>
                                            <strong>Provinsi:</strong>
                                            {{ $address->landmark }}
                                        </p>
                                        <p>
                                            <strong>Kota/Kabupaten:</strong>
                                            {{ $address->city }}
                                        </p>
                                        <p>
                                            <strong>Kecamatan:</strong>
                                            {{ $address->state }}
                                        </p>
                                        <p>
                                            <strong>Kode pos:</strong>
                                            {{ $address->zip }}
                                        </p>
                                        <p>
                                            <strong>No telp:</strong>
                                            {{ $address->phone }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    required=""
                                    value="{{ old('name') }}"
                                />
                                <label for="name">Nama lengkap *</label>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="phone"
                                    required=""
                                    value="{{ old('phone') }}"
                                />
                                <label for="phone">No telepon *</label>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="zip"
                                    required=""
                                    value="{{ old('zip') }}"
                                />
                                <label for="zip">Kode pos *</label>
                                @error('zip')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="state"
                                    required=""
                                    value="{{ old('state') }}"
                                />
                                <label for="state">Kecamatan *</label>
                                @error('state')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="city"
                                    required=""
                                    value="{{ old('city') }}"
                                />
                                <label for="city">Kota / Kabupaten *</label>
                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="address"
                                    required=""
                                    value="{{ old('address') }}"
                                />
                                <label for="address"
                                    >Alamat lengkap / No Rumah / Nama jln
                                    *</label
                                >
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="landmark"
                                    required=""
                                    value="{{ old('landmark') }}"
                                />
                                <label for="landmark">Provinsi *</label>
                                @error('landmark')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="locality"
                                    required=""
                                    value="{{ old('locality') }}"
                                />
                                <label for="locality">Pesan *</label>
                                @error('locality')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="sticky-content">
                        <div class="checkout__totals">
                            <h3>Order</h3>
                            <table class="checkout-cart-items">
                                <thead>
                                    <tr>
                                        <th>PRODUK</th>
                                        <th align="right">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::instance('cart') as $item)
                                    <tr>
                                        <td>
                                            {{ $item->name }} x {{ $item->qty }}
                                        </td>
                                        <td align="right">
                                            Rp.
                                            {{ number_format($item->subtotal) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (Session::has('discounts'))
                            <table class="cart-totals">
                                <tbody>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td class="text-right">
                                            Rp.
                                            {{ Cart::instance('cart')->subtotal() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            DISKON
                                            {{ Session::get('coupon')['code'] }}
                                        </th>
                                        <td class="text-right">
                                            Rp.
                                            {{ number_format(Session::get('discounts')['discount']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL SETELAH DISKON</th>
                                        <td class="text-right">
                                            Rp.
                                            {{ number_format(Session::get('discounts')['subtotal']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PENGIRIMAN</th>
                                        <td class="text-right">Free</td>
                                    </tr>
                                    <tr>
                                        <th>PAJAK</th>
                                        <td class="text-right">
                                            Rp.
                                            {{ number_format(Session::get('discounts')['tax']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td class="text-right">
                                            Rp.
                                            {{ number_format(Session::get('discounts')['total']) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                            <table class="checkout-totals">
                                <tbody>
                                    <tr>
                                        <th>SUBTOTAL</th>
                                        <td class="text-right">
                                            Rp.
                                            {{ Cart::instance('cart')->subtotal() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PENGIRIMAN</th>
                                        <td class="text-right">
                                            Free shipping
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PAJAK</th>
                                        <td class="text-right">
                                            Rp.
                                            {{ Cart::instance('cart')->tax() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td class="text-right">
                                            Rp.
                                            {{ Cart::instance('cart')->total() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </div>

                        {{--
                        <div class="checkout__payment-methods">
                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="mode"
                                    id="mode1"
                                    value="card"
                                />
                                <label class="form-check-label" for="mode1">
                                    Debit or Credit Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="mode"
                                    id="mode2"
                                    value="paypal"
                                />
                                <label class="form-check-label" for="mode2">
                                    Paypal
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="mode"
                                    id="mode3"
                                    value="cod"
                                />
                                <label class="form-check-label" for="mode3">
                                    Cash on delivery
                                </label>
                            </div>

                            <div class="policy-text">
                                Your personal data will be used to process your
                                order, support your experience throughout this
                                website, and for other purposes described in our
                                <a href="terms.html" target="_blank"
                                    >privacy policy</a
                                >.
                            </div>
                        </div>
                        --}}

                        <div class="checkout__payment-methods">
                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="mode"
                                    id="mode1"
                                    value="card"
                                />
                                <label class="form-check-label" for="mode1">
                                    Direct bank transfer
                                    <div class="mb-3 option-detail">
                                        <label
                                            for="brandSelect"
                                            class="form-label fw-bold"
                                            >Pilih Bank</label
                                        >
                                        <select
                                            class="form-select"
                                            name="bank_account_id"
                                            id=""
                                            required
                                        >
                                            <option value="">
                                                -- Pilih Bank --
                                            </option>
                                            @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">
                                                {{ $bank->BANK }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </label>
                            </div>

                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="mode"
                                    id="mode3"
                                    value="cod"
                                    required
                                />
                                <label class="form-check-label" for="mode3">
                                    Cash on delivery (COD)
                                    <p class="option-detail">
                                        Bayar saat produk mu telah sampai
                                    </p>
                                </label>
                            </div>
                        </div>
                        <button
                            class="btn btn-primary btn-checkout"
                            type="submit"
                        >
                            PLACE ORDER
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection
