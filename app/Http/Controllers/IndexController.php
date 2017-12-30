<?php
/**
 * Created by PhpStorm.
 * User: zhouqianyu
 * Date: 2017/12/30
 * Time: 下午12:16
 */

namespace App\Http\Controllers;


use App\Cart;
use App\Greens;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $type = isset($_GET['type'])?$_GET['type']:1;
        $greens = Greens::where('type',$type)->get()->toArray();
        $cart = Cart::where('user_id',$_COOKIE['userId'])->get()->toArray();
        $cartCount = Cart::select(DB::raw('sum(num) as count'))->first()->count;
        $cart = array_column($cart,'num','greens_id');
        foreach ($greens as $k => $v){
            if (key_exists($v['id'],$cart)) $greens[$k]['count'] = $cart[$v['id']];
            else $greens[$k]['count'] = 0;
        }
        return view('index',['type'=>$type,'data'=>$greens,'cartCount'=>$cartCount]);
    }
}