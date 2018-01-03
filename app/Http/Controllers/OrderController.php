<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Cart;

class OrderController extends Controller
{
    public function myOrder()
    {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $openId = $this->getOpenId($code);
            setcookie('userId', $openId, time() + 7200, '/');
            $_COOKIE['userId'] = $openId;
        }
        $userId = $_COOKIE['userId'];
        $type = isset($_GET['type']) ? $_GET['type'] : 0;
        switch ($type) {
            case 1:
                $typeArr = [1, 2, 3];
                break;
            case 2:
                $typeArr = [4];
                break;
            case 3:
                $typeArr = [5];
        }
        if ((int)$type === 0) $bills = Bill::where('user_id', $userId)->get()->toArray();
        else $bills = Bill::where('user_id', $userId)->whereIn('type', $typeArr)->get()->toArray();
        return view('myOrder', ['type' => (int)$type, 'data' => $bills]);
    }

    public function view()
    {
        $userId = $_COOKIE['userId'];
        $cart = Cart::where('user_id', $userId)->join('greens', 'cart.greens_id', '=', 'greens.id')
            ->select('greens.id', 'name', 'num', 'price')->get()->toArray();
        $bill = Bill::where('user_id', $_COOKIE['userId'])->where('type', 1)->first();
        if ($bill!=null) $bill = $bill->toArray();
        $total = 0;
        foreach ($cart as $v) {
            $total += $v['price'] * $v['num'];
        }
        if($total > 50) {
            $onsale_price = 20;
        }else{
            $onsale_price = 0;
        }

        return view('order', ['data' => $cart, 'total' => $total, 'onsale_price' => $onsale_price]);
    }

    public function confirm()
    {
        $userId = $_COOKIE['userId'];
        $tableNum = $_GET['tableNum'];
        $remark = $_GET['remark'];
        $cart = Cart::where('user_id', $userId)->join('greens', 'cart.greens_id', '=', 'greens.id')
            ->select('greens.id', 'name', 'num', 'price')->get()->toArray();
        $bill = Bill::where('user_id', $userId)->where('type', 1)->first();
        if (!$bill) {
            $total = 0;
            $bill = Bill::create([
                'type' => 1,
                'user_id' => $userId,
                'table_num' => $tableNum,
                'remark' => $remark
            ]);
            foreach ($cart as $v) {
                $total += $v['price'] * $v['num'];
                $bill->greens()->attach($v['id'], ['num' => $v['num']]);
            }
            $bill->price = $total;
            if ($total >= 50) $bill->onsale_price = 20;
            else $bill->onsale_price = 0;
            $bill->save();
            Cart::where('user_id', $userId)->delete();
            return view('orderSubmitted', ['data' => $cart, 'total' => $total, 'bill' => $bill, 'table_num' => $tableNum, 'remark' => $remark]);
        } else {
            $total = $bill->price;
            $totalAdd = 0;
            foreach ($cart as $v) {
                $totalAdd += $v['price'] * $v['num'];
                $bill->greens()->attach($v['id'], ['num' => $v['num']]);
            }
            $total = $total + $totalAdd;
            $bill->price = $total;
            $bill->save();
            Cart::where('user_id', $userId)->delete();
            return view('orderAddFood', ['data' => $cart, 'total' => $totalAdd, 'bill' => $bill]);
        }
    }

    public function submit()
    {
        $id = $_GET['id'];
        $bills = Bill::where('id', $id)->with('greens')->first()->toArray();
        return view('orderPay', ['data' => $bills, 'id' => $bills['id']]);
    }

    public function pay()
    {
        $id = $_GET['id'];
        $bill = Bill::find($id);
        $bill->type = 4;
        $bill->save();
        $bills = Bill::where('id', $id)->with('greens');
        return view('paySuccess', ['data' => $bills->first()->toArray()]);
    }

    public function cancel()
    {
        $id = $_GET['id'];
        $bill = Bill::find($id);
        $bill->type = 5;
        $bill->save();
        $bills = Bill::where('id', $id)->with('greens');
        return view('orderCancel', ['data' => $bills->first()->toArray()]);
    }

    public function detail()
    {
        $id = (int)$_GET['id'];
        $bill = Bill::where('id', $id)->with('greens')->first()->toArray();
        $type = $bill['type'];
        switch ($type) {
            case 4:
                return view('paySuccess', ['data' => $bill, 'id' => $bill['id'], 'total' => $bill['price'], 'detail' => true]);
            case 5:
                return true;
            default:
                return view('orderSubmitted', ['data' => $bill, 'id' => $bill['id'], 'total' => $bill['price'], 'detail' => true]);
        }
    }
}
