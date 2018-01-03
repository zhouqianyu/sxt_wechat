<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/order.css')}}">
    <title>点餐下单</title>
</head>
<body>
    <div class="header">
        <span class="tableNum">我的桌号</span>
        <input class="tableNumInput" placeholder="输入桌号" id="tableNumInput" value="@if(!empty($bill)) {{$bill['table_num']}} @endif"/>
    </div>
    <div class="main">
        <div class="mainHeader">
            <span>我的菜单</span>
        </div>
        @foreach($data as $v)
        <div class="mainCenter">
            <div class="mainItem">
                <span class="foodName">{{$v['name']}}</span>
                <span class="foodNum">x{{$v['num']}}</span>
                <span class="money">￥{{$v['price']}}</span>
            </div>
        </div>
        @endforeach
        <div class="remarkContainer">
            <span style="padding-left: 1rem">订单备注</span>
            <input class="addRemark" placeholder="添加备注" id="remark" value="@if(!empty($bill)) {{$bill['remark']}} @endif"/>
        </div>
    </div>
    <div class="totalContainer">
        <div class="totalHeader">
            <span class="totalLeft">合计</span>
            <span class="totalMoney">￥{{$total}}</span>
        </div>
        <div class="totalCenter">
            <span class="totalLeft">不参与优惠金额</span>
            <span class="onSale">￥{{$total - $onsale_price}}</span>
        </div>
        <div class="totalBottom">
            <span class="totalLeft">参与优惠金额</span>
            <span class="totalMoney">￥{{$onsale_price}}</span>
        </div>
    </div>
    <div class="bottom">
        <div class="continueAdd" onclick="toMenu()">
            继续点菜
        </div>
        <div class="pay" onclick="toConfirm()">
            确认下单
        </div>
    </div>
</body>
<script>
    function toMenu() {
        window.location.href = '{{route('index')}}';
    }
    function toConfirm() {
        let tableNum = document.getElementById('tableNumInput').value;
        let remark = document.getElementById('remark').value;
        window.location.href = '{{URL::asset('order/confirm')}}?tableNum='+tableNum+'&remark='+ remark;
    }
</script>
</html>