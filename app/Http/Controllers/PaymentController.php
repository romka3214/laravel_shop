<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class PaymentController extends Controller
{
    public function paymentRedirect()
    {
        $id = Auth::user()->id;

        $payment = Cart::select('items.name as item', 'carts.count as count', 'items.price as price', 'items.id as itemId', 'carts.status as status')
            ->join('items', 'items.id', '=', 'carts.item')
            ->join('users', 'users.id', '=', 'carts.user')
            ->where('user', $id)
            ->where('status', 0)
            ->get();
            
        if($payment->isEmpty()){
            return redirect()->route('cartRedirect');
        }

        $sum = 0;
        foreach ($payment as $p) {
            $sum += ($p->price) * ($p->count);
        }
        foreach ($payment as $c) {
            $i = $c->count * $c->price;
            $sumItem[] = $i;
        }

        return view('payment', ['info' => $payment, 'sum' => $sum, 'sumItem' => $sumItem]);
    }

    public function sendOrder(Request $r)
    {

        switch ($r->DeliveryMethod) {
            case 'RusPost':
                $delivery = 'Почта России';
                break;
            case 'SDEK':
                $delivery = 'СДЭК';
                break;
            case 'Sber':
                $delivery = 'СберЛогистика-Курьер';
                break;
        }
        switch ($r->paymentMethod) {
            case 'card':
                $payment = 'Картой-онлайн';
                break;
            case 'cartOnHand':
                $payment = 'Картой-курьеру';
                break;
            case 'cash':
                $payment = 'Наличные';
                break;
        }

        if (Orders::create(['delivery' => $delivery, 'pay_method' => $payment, 'address' => $r->address, 'cost' => $r->fullCost, 'user_id' => Auth::id(), 'comment' => $r->comment])) {
            $newID = Orders::select('orders.id as id')->latest()->first();
            Cart::where([['user', Auth::id()], ['order_id', null]])->update(['status' => 1, 'order_id' => $newID->id]);

            // Отправка email пользователю с благодарностью

            $email = Auth::user()->email;    
            $order = Orders::where('orders.id', $newID->id)->get();
            $items = Cart::select('carts.count as count', 'items.name as name', 'items.price as price')
            ->where('order_id', $newID->id)
            ->join('items', 'items.id', '=', 'carts.item')
            ->get();
     
                Mail::to($email)->send(new OrderMail($items, $order));

            return response()->json(['success' => $r -> comment]);
        } else {
            return response()->json(['errors' => 'ошибка при добавлении', 200]);
        }
    }

    public function successPayment()
    {
        return view('success');
    }
}
