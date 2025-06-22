<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\OrderItem;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('frontend.cart', compact('items'));
    }

    public function add_to_cart(Request $request)
    {
        Cart::instance('cart')->add(
            $request->id,
            $request->name,
            $request->quantity,
            $request->price,
        )->associate('App\Models\Product');
        return redirect()->back();
    }

    public function update_cart_quantity(Request $request, $rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty;

        if ($request->action === 'increase') {
            $qty += 1;
        } elseif ($request->action === 'decrease' && $qty > 1) {
            $qty -= 1;
        }

        Cart::instance('cart')->update($rowId, $qty);

        return redirect()->back();
    }

    public function remove_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon_code = $request->coupon_code;
        if (isset($coupon_code)) {
            $coupon = Coupon::where('code', $coupon_code)
                ->where('expiry_date', '>=', Carbon::today())
                ->where('cart_value', '<=', floatval(preg_replace('/[^\d.]/', '', Cart::instance('cart')->subtotal())))
                ->first();
            if (!$coupon) {
                return redirect()->back()->with('error', 'Voucher tidak valid!');
            } else {
                Session::put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => floatval($coupon->value), // pastikan angka
                    'cart_value' => floatval($coupon->cart_value),
                ]);
                $this->calculateDiscount();
                return redirect()->back()->with('success', 'Voucher diskon berhasil di gunakan!');
            }
        } else {
            return redirect()->back()->with('error', 'Voucher tidak valid!');
        }
    }

    public function calculateDiscount()
    {
        $discount = 0;
        $subtotalRaw = floatval(preg_replace('/[^\d.]/', '', Cart::instance('cart')->subtotal()));

        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');
            $value = floatval(preg_replace('/[^\d.]/', '', $coupon['value']));

            if ($coupon['type'] == 'fixed') {
                $discount = $value;
            } else {
                $discount = ($subtotalRaw * $value) / 100;
            }

            $subtotalAfterDiscount = $subtotalRaw - $discount;
            $taxAfterDiscount = ($subtotalAfterDiscount * config('cart.tax')) / 10;
            $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

            Session::put('discounts', [
                'discount' => number_format($discount, 2, '.', ''),
                'subtotal' => number_format($subtotalAfterDiscount, 2, '.', ''),
                'tax' => number_format($taxAfterDiscount, 2, '.', ''),
                'total' => number_format($totalAfterDiscount, 2, '.', ''),
            ]);
        }
    }

    public function remove_coupon_code()
    {
        Session::forget('coupon');
        Session::forget('discounts');
        return back()->with('success', 'Voucher has been removed !');
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $address = Address::where('user_id', Auth::user()->id)->where('isdefault', 1)->first();
        $banks = BankAccount::where('is_active', true)->get();
        return view('frontend.checkout', compact('address', 'banks'));
    }

    public function place_an_order(Request $request)
    {
        $user_id = Auth::user()->id;
        $address = Address::where('user_id', $user_id)->where('isdefault', true)->first();

        if (!$address) {
            $request->validate([
                'name' => 'required|max:100',
                'phone' => 'required|numeric|digits:12',
                'zip' => 'required|numeric',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'locality' => 'required',
                'landmark' => 'required',
            ]);

            $address = new Address();
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->zip = $request->zip;
            $address->state = $request->state;
            $address->city = $request->city;
            $address->address = $request->address;
            $address->locality = $request->locality;
            $address->landmark = $request->landmark;
            $address->country = 'Indonesia';
            $address->user_id = $user_id;
            $address->isdefault = true;
            $address->save();
        }

        $this->setAmountForCheckout();

        $order = new Order();
        $order->user_id = $user_id;
        $order->subtotal = str_replace(',', '', Session::get('checkout')['subtotal']);
        $order->discount = str_replace(',', '', Session::get('checkout')['discount']);
        $order->tax = str_replace(',', '', Session::get('checkout')['tax']);
        $order->total = str_replace(',', '', Session::get('checkout')['total']);
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->locality = $address->locality;
        $order->address = $address->address;
        $order->city = $address->city;
        $order->state = $address->state;
        $order->country = $address->country;
        $order->landmark = $address->landmark;
        $order->zip = $address->zip;
        $order->save();

        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        if ($request->mode == "card") {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = 'card'; // berarti transfer bank
            $transaction->status = 'pending';
            $transaction->bank_account_id = $request->bank_account_id; // Tambahkan ini
            $transaction->save();
        } elseif ($request->mode == "paypal") {
            //
        } elseif ($request->mode == "cod") {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = $request->mode;
            $transaction->status = "pending";
            $transaction->save();
        }


        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');
        Session::put('order_id', $order->id);
        return redirect()->route('cart.order.confirmation');
    }

    public function setAmountForCheckout()
    {
        if (!Cart::instance('cart')->content()->count() > 0) {
            Session::forget('checkout');
            return;
        }

        if (Session::has('coupon')) {
            Session::put('checkout', [
                'discount' => Session::get('discounts')['discount'],
                'subtotal' => Session::get('discounts')['subtotal'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total'],
            ]);
        } else {
            Session::put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }
    }

    public function order_confirmation()
    {
        if (Session::has('order_id')) {
            $order = Order::find(Session::get('order_id'));

            $transaction = $order->transaction()->with('bankAccount')->first();
            return view('frontend.order-confirmation', compact('order', 'transaction'));
        }
        return redirect()->route('cart.index');
    }
}
