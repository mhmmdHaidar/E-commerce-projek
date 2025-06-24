@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Addresses</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__address">
                        <div class="my-account__address-list row">
                            <h5>Shipping Address</h5>

                            <div class="my-account__address-item col-md-6">
                                @if (Session::has('success'))
                                    <p class="alert alert-success text-center">
                                        {{ Session::get('success') }}
                                    </p>
                                @endif
                                @if ($address)
                                    <div class="my-account__address-item__title">
                                        <h5>{{ $address->name }} <i class="fa fa-check-circle text-success"></i></h5>
                                        <a href="#">
                                            <h5>Edit</h5>
                                        </a>
                                    </div>
                                    <div class="my-account__address-item__detail">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <td>
                                                        <h4>Username</h4>
                                                    </td>
                                                    <td>
                                                        <h4>Username</h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>Kecamatan</h4>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $address->state }}</h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>Kota / kabupaten</h4>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $address->city }}</h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>Provinsi</h4>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $address->landmark }}</h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>Alamat Lengkap :</h4>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $address->address }}</h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>Kode Pos</h4>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $address->zip }}</h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>No Telpon</h4>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $address->phone }}</h4>
                                                    </td>
                                                </tr>
                                            </table>
                                            <form action="{{ route('address.delete', $address->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <h2>Alamat Belum di tambahkan</h2>
                                    <form action="{{ route('account.address.add') }}">
                                        <button class="btn btn-outline-dark">Tambah Alamat</button>
                                    </form>
                                @endif
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this category?",
                    type: "warning",
                    buttons: ["No", "Yes"],
                    confirmButtonColor: "#dc3545",
                }).then(function(result) {
                    if (result) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
