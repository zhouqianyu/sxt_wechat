<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/orderSubmitted.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/orderPay.css')}}">
    <title>点餐支付</title>
</head>
<body>
<div class="mainPay">
    <div class="mainHeader">
        <span>小台餐厅(青山店)</span>
        <span class="table">桌号</span>
        <span class="tableNum">{{$bill['table_num']}}}</span>
    </div>
    <div class="mainCenter">
        @foreach($data['greens'] as $v)
            <div class="mainItem">
                <span class="foodName">{{$v['name']}}</span>
                <span class="foodNum">x{{$v['pivot']['num']}}</span>
                <span class="money">￥{{$v['price']}}</span>
            </div>
        @endforeach
    </div>
    <div class="remarkContainer">
        <span style="padding-left: 1rem">订单备注</span>
        <span class="addRemark">点击添加备注</span>
    </div>
</div>
<div class="totalContainer">
    <div class="totalHeader">
        <span class="totalLeft">合计</span>
        <span class="totalMoney">￥{{$data['price']}}</span>
    </div>
    <div class="totalCenter">
        <span class="totalLeft">不参与优惠金额</span>
        <span class="onSale">￥19.09</span>
    </div>
    <div class="totalBottom">
        <span class="totalLeft">参与优惠金额</span>
        <span class="totalMoney">￥23.33</span>
    </div>
</div>
<div class="payBottom">
    <div class="toPay" onclick="toPay({{$id}})">
        去支付￥{{$data['price']}}
    </div>
</div>
</body>
<script>
    function toPay(id) {
        window.location.href = '{{URL::asset('order/pay')}}?id='+id;
    }
</script>
</html>