@extends('layouts.admin') @section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="tf-section-2 mb-30">
            <div class="flex gap20 flex-wrap-mobile">
                <div class="w-half">
                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Total Pesanan
                                    </div>
                                    <h4>{{ $dashboardDatas[0]->Total }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Total Pendapatan
                                    </div>
                                    <h4>
                                        Rp.
                                        {{ number_format($dashboardDatas[0]->TotalAmount) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Pesanan Pending
                                    </div>
                                    <h4>
                                        {{ $dashboardDatas[0]->TotalOrdered }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Total Pesanan pending
                                    </div>
                                    <h4>
                                        Rp.
                                        {{ number_format($dashboardDatas[0]->TotalOrderedAmount) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-half">
                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Pesanan Di kirim
                                    </div>
                                    <h4>
                                        {{ $dashboardDatas[0]->TotalDelivered }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Total Pesanan di Kirim
                                    </div>
                                    <h4>
                                        Rp.
                                        {{ number_format($dashboardDatas[0]->TotalDeliveredAmount) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Pesanan Di Batalkan
                                    </div>
                                    <h4>
                                        {{ $dashboardDatas[0]->TotalCanceled }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">
                                        Total Pesanan di Batalkan
                                    </div>
                                    <h4>
                                        Rp.
                                        {{ number_format($dashboardDatas[0]->TotalCanceledAmount) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Pendapatan bulanan</h5>
                </div>
                <div class="flex flex-wrap gap40">
                    <div>
                        <div class="mb-2">
                            <div class="block-legend">
                                <div class="dot t1"></div>
                                <div class="text-tiny">Total</div>
                            </div>
                        </div>
                        <div class="flex items-center gap10">
                            <h4>Rp. {{ number_format($TotalAmount) }}</h4>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2">
                            <div class="block-legend">
                                <div class="dot t2"></div>
                                <div class="text-tiny">Pending</div>
                            </div>
                        </div>
                        <div class="flex items-center gap10">
                            <h4>
                                Rp. {{ number_format($TotalOrderedAmount) }}
                            </h4>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2">
                            <div class="block-legend">
                                <div class="dot t3"></div>
                                <div class="text-tiny">Delivered</div>
                            </div>
                        </div>
                        <div class="flex items-center gap10">
                            <h4>
                                Rp. {{ number_format($TotalDeliveredAmount) }}
                            </h4>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2">
                            <div class="block-legend">
                                <div class="dot t4"></div>
                                <div class="text-tiny">Canceled</div>
                            </div>
                        </div>
                        <div class="flex items-center gap10">
                            <h4>
                                Rp. {{ number_format($TotalCanceledAmount) }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div id="line-chart-8"></div>
            </div>
        </div>
        <div class="tf-section mb-30">
            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Pesanan Terbaru</h5>
                    <div class="dropdown default">
                        <a
                            class="btn btn-secondary dropdown-toggle"
                            href="{{ route('admin.orders') }}"
                        >
                            <span class="view-all">Lihat semua</span>
                        </a>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 70px" class="text-center">
                                        NO
                                    </th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">No telp</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Pajak</th>
                                    <th class="text-center">Subtotal</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal Order</th>
                                    <th class="text-center">Total Items</th>
                                    <th class="text-center">Dikirim Pada</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->phone }}
                                    </td>
                                    <td class="text-center">
                                        Rp.
                                        {{ number_format($order->subtotal) }}
                                    </td>
                                    <td class="text-center">
                                        Rp. {{ number_format($order->tax) }}
                                    </td>
                                    <td class="text-center">
                                        Rp. {{ number_format($order->total) }}
                                    </td>

                                    <td class="text-center">
                                        @if ($order->status == 'delivered')
                                        <span class="badge bg-success"
                                            >Delivered</span
                                        >
                                        @elseif ($order->status == 'canceled')
                                        <span class="badge bg-danger"
                                            >Cenceled</span
                                        >
                                        @else
                                        <span class="badge bg-warning"
                                            >Ordered</span
                                        >
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $order->created_at }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->orderItems->count() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->delivered_date }}
                                    </td>
                                    <td class="text-center">
                                        <a
                                            href="{{ route('admin.order.details', ['order_id' => $order->id]) }}"
                                        >
                                            <div
                                                class="list-icon-function view-icon"
                                            >
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @push('scripts')
<!-- <script>
        (function($) {

            var tfLineChart = (function() {

                var chartBar = function() {

                    var options = {
                        series: [{
                                name: 'Total',
                                data: [{{ $AmountM }}]

                            }, {
                                name: 'Pending',
                                data: [{{ $OrderedAmountM }}]
                            },
                            {
                                name: 'Delivered',
                                data: [{{ $DeliveredAmountM }}]
                            }, {
                                name: 'Canceled',
                                data: [{{ $CanceledAmountM }}]
                            }
                        ],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                                'Oct', 'Nov', 'Dec'
                            ],
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return "Rp. " + val.toLocaleString("id-ID");
                                }
                            }
                        }
                    };

                    chart = new ApexCharts(
                        document.querySelector("#line-chart-8"),
                        options
                    );
                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }
                };

                /* Function ============ */
                return {
                    init: function() {},

                    load: function() {
                        chartBar();
                    },
                    resize: function() {},
                };
            })();

            jQuery(document).ready(function() {});

            jQuery(window).on("load", function() {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function() {});
        })(jQuery);
    </script> -->

<script>
    (function($) {

        var tfLineChart = (function() {

            var chartBar = function() {

                var options = {
                    series: [{
                            name: 'Total',
                            data: [{{ $AmountM }}]
                        }, {
                            name: 'Pending',
                            data: [{{ $OrderedAmountM }}]
                        },
                        {
                            name: 'Delivered',
                            data: [{{ $DeliveredAmountM }}]
                        }, {
                            name: 'Canceled',
                            data: [{{ $CanceledAmountM }}]
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 325,
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '10px',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false,
                    },
                    colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                    stroke: {
                        show: false,
                    },
                    xaxis: {
                        labels: {
                            style: {
                                colors: '#212529',
                            },
                        },
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                            'Oct', 'Nov', 'Dec'
                        ],
                    },
                    yaxis: {
                        show: false,
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Rp. " + val.toLocaleString("id-ID");
                            }
                        }
                    }
                };

                chart = new ApexCharts(
                    document.querySelector("#line-chart-8"),
                    options
                );
                if ($("#line-chart-8").length > 0) {
                    chart.render();
                }
            };

            /* Function ============ */
            return {
                init: function() {},

                load: function() {
                    chartBar();
                },
                resize: function() {},
            };
        })();

        jQuery(document).ready(function() {});

        jQuery(window).on("load", function() {
            tfLineChart.load();
        });

        jQuery(window).on("resize", function() {});
    })(jQuery);
</script>
@endpush
