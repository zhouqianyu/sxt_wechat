<?php

namespace App\Http\Controllers;

use App\Cart;

class CartController extends Controller
{
    public function change()
    {
        $userId = $_COOKIE['userId'];
        $id = $_POST['id'];
        $count = $_POST['count'];
        if ($count === 0) {
            $cart = Cart::find($id)->delete();
        } else {
            $cart = Cart::updateOrCreate([
                'greens_id' => $id,
                'user_id' => $userId,
            ], [
                'num' => $count
            ]);
        }
        if ($cart) {
            $this->json_die(['code' => 200, 'msg' => 'success']);
        }
    }

    public function view()
    {
        $userId = $_COOKIE['userId'];
        $cart = Cart::where('user_id', $userId)->join('greens', 'cart.greens_id', '=', 'greens.id')
            ->select('greens.id','name','num','price')->get()->toArray();
        $total = 0;
        foreach ($cart as $v){
            $total+=$v['price']*$v['num'];
        }
        return view('cart', ['data' => $cart,'total'=>$total]);
    }
}
