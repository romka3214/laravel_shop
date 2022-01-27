<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartRedirect()
    {

        $id = Auth::user()->id;

        $cart = Cart::select('items.img as img', 'cats.name as cat', 'items.name as item', 'carts.count as count', 'items.price as price', 'carts.id as id', 'items.id as itemId')
        ->join('items', 'items.id', '=', 'carts.item')
        ->join('users', 'users.id', '=', 'carts.user')
        ->join('cats', 'cats.id', '=', 'items.cat')
        ->where('user', $id)
        ->where('status', 0)
        ->get();


        $sum = 0;
        foreach ($cart as $c) {
            $sum += ($c -> price) * ($c -> count);
        }


        return view('cart', ['info' => $cart, 'sum' => $sum]);
    }

    public function addItemToCart(Request $r){
        $id = $r -> item;

        $cart = Cart::where('item', $id)->where('user', Auth::user()->id)->where('status', '0')->first();

        if (is_null($cart)) {
            Cart::create([
                'item' => $id,
                'user' => Auth::user()->id,
                'count' => '1'
            ]);
        } else{
            $cart->count = $cart -> count + 1;
            $cart -> save();
        }

       // $count = Cart::selectRaw('COUNT(count) as count')->where('user', Auth::user()->id)->first();

        $count = Cart::selectRaw('SUM(count) as count')->where('user', Auth::user()->id)->where('status', 0)->first();

        return $count->count;
        
        // return response()->json(['success'=> $r -> item]);
    }

    public static function countCart()
    {
        $count = Cart::selectRaw('SUM(count) as count')->where('user', Auth::user()->id)->where('status', 0)->first();

        return $count -> count;
    }

    public function countItem(Request $r)
    {
        $choose = $r->let;
        $cart = Cart::find($r->id);
        if ($choose == 'minus') {
            $cart->count--;
        } else{
            $cart->count++;
        }
        $cart-> save();

        $item = Items::find($cart->item);
        $sum = $cart->count * $item->price;
        $sum = number_format($sum, 0, '', ' ');

        $countAll = Cart::selectRaw('SUM(count) as count')->where([['user', Auth::id()], ['order_id', null]])->first();

        $summa =  Cart::selectRaw('SUM(items.price * carts.count) as sum')->join('items', 'items.id', '=', 'carts.item')->where([['user', Auth::id()], ['order_id', null]])->first();
        $summa = number_format($summa->sum, 0, '', ' ');

        return response()->json(['count' => $cart->count, 'price' => $sum, 'countAll' => $countAll->count, 'summa' => $summa], 200);
    }

    public function removeItem($id){
        Cart::where('carts.id', $id)->delete();

        return redirect()->route('cartRedirect');
    }
}
