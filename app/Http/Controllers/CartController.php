<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
}
