@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>{{ $user->name }}</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}">
                            <div class="text-tiny">All User</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}">
                            <div class="text-tiny">{{ $user->name }}</div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="wg-box">

                <div class="row">
                    <!-- Profile Card -->
                    <div class="col-md-4">
                        <div class="card shadow-sm rounded">
                            <div class="card-body text-center">
                                <img src="{{ asset($user->avatar ?? 'uploads/avatars/default.png') }}"
                                    class="rounded-circle" width="300" height="300" alt="Profile Picture"
                                    style="object-fit: cover; aspect-ratio: 1 / 1;">
                                <h5 class="card-title">{{ $user->name }}</h5>

                            </div>
                        </div>
                    </div>

                    <!-- User Info & Orders -->
                    <div class="col-md-8">
                        {{-- <div class="card shadow-sm rounded mb-3">
                            <div class="card-header bg-light fw-bold">Informasi User</div>
                            <div class="card-body">
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Telepon:</strong> {{ $user->mobile }}</p>
                                <p><strong>Jumlah Pesanan:</strong> {{ $user->orders->count() }}</p>
                            </div>
                        </div> --}}

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Username</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <td>{{ $user->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pesanan</th>
                                    <td>{{ $user->orders->count() }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card shadow-sm rounded">
                            <div class="card-header bg-light fw-bold">Daftar Pesanan</div>
                            <div class="card-body">
                                @forelse($user->orders as $order)
                                    <div class="mb-3 p-3 border rounded">
                                        <p><strong>ID Order:</strong> #{{ $order->id }}</p>
                                        <p><strong>Alamat:</strong> {{ $order->address }}, {{ $order->city }},
                                            {{ $order->state }} - {{ $order->zip }}</p>
                                        <p><strong>Status:</strong>
                                            {{-- {{ ucfirst($order->status) }} --}}
                                            @if ($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @elseif ($order->status == 'canceled')
                                                <span class="badge bg-danger">Cenceled</span>
                                            @else
                                                <span class="badge bg-warning">Ordered</span>
                                            @endif
                                        </p>
                                        <p><strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                @empty
                                    <p class="text-muted">User ini belum pernah melakukan pesanan.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </div>
@endsection
