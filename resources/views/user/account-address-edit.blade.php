@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Address</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__address">
                        <div class="row">
                            <div class="col-6">
                                <p class="notice">The following addresses will be used on the checkout page by default.</p>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('account.address') }}" class="btn btn-sm btn-danger">Back</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-5">
                                    <div class="card-header">
                                        <h5>Add New Address</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('account.address.update', $address->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <input type="hidden" name="locality" value="unknown">
                                                <input type="hidden" name="country" value="indonesia">
                                                <div class="col-md-6">
                                                    <div class="form-floating my-3">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $address->name }}">
                                                        <label for="name">Nama Lengkap *</label>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating my-3">
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ $address->phone }}">
                                                        <label for="phone">Nomor telepon *</label>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input type="text" class="form-control" name="zip"
                                                            value="{{ $address->zip }}">
                                                        <label for="zip">Kode pos *</label>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mt-3 mb-3">
                                                        <input type="text" class="form-control" name="state"
                                                            value="{{ $address->state }}">
                                                        <label for="state">Kecamatan *</label>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating my-3">
                                                        <input type="text" class="form-control" name="city"
                                                            value="{{ $address->city }}">
                                                        <label for="city">Kota / Kabupaten *</label>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating my-3">
                                                        <input type="text" class="form-control" name="landmark"
                                                            value="{{ $address->landmark }}">
                                                        <label for="landmark">Provinsi *</label>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-floating my-3">
                                                        <input type="text" class="form-control" name="address"
                                                            value="{{ $address->address }}">
                                                        <label for="address">Alamat Lengkap *</label>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="isdefault" value="1">
                                                {{-- <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            id="isdefault" name="isdefault">
                                                        <label class="form-check-label" for="isdefault">
                                                            Make as Default address
                                                        </label>
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-12 text-right">
                                                    <button type="submit" class="btn btn-outline-dark">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
