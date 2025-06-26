<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function index()
    {
        $items = Cart::instance('wishlist')->content();
        return view('frontend.wishlist', compact('items'));
    }

    public function add_to_wishlist(Request $request)
    {
        Cart::instance('wishlist')->add(
            $request->id,
            $request->name,
            $request->quantity,
            $request->price,
        )->associate('App\Models\Product');

        notify()->success('Berhasil memasukkan produk ke wishlist!');
        return redirect()->back();
    }

    public function remove_item($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);

        return redirect()->back();
    }

    public function empty_wishlist()
    {
        Cart::instance('wishlist')->destroy();
        notify()->success('Berhasil hapus wishlist!');
        return redirect()->back();
    }

    public function move_to_cart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add(
            $item->id,
            $item->name,
            $item->qty,
            $item->price
        )->associate('App\Models\Product');

        notify()->success('Berhasil memasukkan produk ke keranjang!');

        return redirect()->back();
    }
}
