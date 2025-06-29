<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;

// use PDF;
use App\Exports\UserExport;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class AdminReportController extends Controller
{
    public function orderForm()
    {
        return view('admin.v_reports.form-order');
    }

    public function exportOrder(Request $request)
    {
        $data = Order::whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        if ($request->format == 'pdf') {
            $pdf = PDF::loadView('laporan.exports.order_pdf', [
                'orders' => $data,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
            return $pdf->download('laporan-order.pdf');
        } else {
            return Excel::download(new OrderExport($request->start_date, $request->end_date), 'laporan-order.xlsx');
        }
    }

    public function userForm()
    {
        return view('admin.v_reports.form-user');
    }

    public function exportUser(Request $request)
    {
        $data = User::where('utype', 'USR')
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->get();

        if ($request->format == 'pdf') {
            $pdf = PDF::loadView('laporan.exports.user_pdf', [
                'users' => $data,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
            return $pdf->download('laporan-user.pdf');
        } else {
            return Excel::download(new UserExport($request->start_date, $request->end_date), 'laporan-user.xlsx');
        }
    }

    public function produkForm()
    {
        return view('admin.v_reports.form-produk');
    }

    public function exportproduk(Request $request)
    {
        $data = Product::whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        if ($request->format == 'pdf') {
            $pdf = PDF::loadView('laporan.exports.produk_pdf', [
                'products' => $data,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
            return $pdf->download('laporan-produk.pdf');
        } else {
            return Excel::download(new ProdukExport($request->start_date, $request->end_date), 'laporan-produk.xlsx');
        }
    }
}
