<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\NavbarTrait;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        $carts = Cart::with(['product.galleries','user'])
                     ->where('users_id', Auth::user()->id)->get();
        return view('pages.cart',[
            'carts' => $carts,
            'total_notif' => $total_notif,
            'notif_pesan' => $notif_pesan,
            'list_notif_display' => $list_notif_display,
            'notif_grup' => $notif_group
        ]);
    }

    public function delete(Request $request, $id){

        $cart = Cart::findOrFail($id);

        $produk = Product::find($cart->products_id);

        $jumlah = $produk->stock + $cart->qty;
        $produk->update(['stock'=> $jumlah]);
        $produk->save();


        $cart->delete();
        return redirect('/');
    }

    public function success()
    {
        return view('pages.success');
    }
}
