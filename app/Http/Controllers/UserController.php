<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('user.orders', compact('orders'));
    }

    public function order_details($order_id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order->id)->first();
        return view('user.order-details', compact('order', 'orderItems', 'transaction'));
    }

    public function detail_order($order_id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order->id)->first();
        // return view('user.order-details', compact('order', 'orderItems', 'transaction'));

        return redirect()->route('cart.order.confirmation', compact('order', 'orderItems', 'transaction'));
    }

    public function order_cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = "canceled";
        $order->canceled_date = Carbon::now();
        $order->save();
        return back()->with('status', 'order berhasil di cencel !');
    }

    public function address()
    {
        $user = Auth::user();
        $address = $user->addresses()->first(); // Ambil alamat pertama (bisa disesuaikan)
        return view('user.account-address', compact('user', 'address'));
    }

    public function add_address()
    {
        return view('user.account-address-add');
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'city' => 'required',
            'landmark' => 'required',
            'address' => 'required',
            'country' => 'required',
            'locality' => 'required'
        ]);

        $data = $request->only([
            'name',
            'phone',
            'zip',
            'state',
            'city',
            'landmark',
            'address',
            'locality',
            'country'
        ]);
        $data['user_id'] = $request->user()->id; // atau $request->user()->id
        $data['isdefault'] = $request->has('isdefault') ? 1 : 0;

        Address::create($data);

        return redirect()->route('account.address')->with('success', 'Alamat berhasil disimpan.');
    }

    public function address_delete($id)
    {
        $address = Address::findOrFail($id);

        if ($address->user_id != auth()->id()) {
            abort(404, 'Unauthorized action.');
        }

        $address->delete();

        return redirect()->route('account.address')->with('success', 'Alamat berhasil dihapus.');
    }
}
