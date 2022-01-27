<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RewRequest;
use App\Models\Cats;
use App\Models\Items;
use App\Models\Rew;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class ItemsController extends Controller
{
    public function items(Request $request)
    {

        $cats = Cats::all();

        $id = $request->id;

        if (is_null($id)) {
            $items = Items::all();
        } else {
            $items = Items::where('cat', $id)->get();
        }
        return view('main', ['cats' => $cats, 'items' => $items, 'id' => $id]);
    }

    public function openItem(Request $request)
    {

        $id = $request->id;
        $item = Items::where('id', $id)->first();
        $rewiews = Rew::where('item', $id)->get();
        return view('item', ['item' => $item, 'rewiews' => $rewiews]);
    }

    static function formatPrice($price)
    {
        return number_format($price, 0, '', ' ');
    }

    public function newRewiew($id, RewRequest $r)
    {

        $rew = new Rew();

        $rew->score = $r->score;
        $rew->text = $r->text;
        $rew->user_name = Auth::user()->name;
        $rew->item = $id;

        $rew->save();



        if ($rew->errors) {
            return response()->json(['error' => $rew->errors]);
        } else {
            return response()->json(['success' => 'Спасибо за отзыв!', 'sc' => $rew->score, 'tx' => $rew->text, 'user' => $rew->user_name]);
        }
    }


}
