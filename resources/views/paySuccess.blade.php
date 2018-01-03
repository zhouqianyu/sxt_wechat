<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/orderSubmitted.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/paySuccess.css')}}">
    <title>点餐下单</title>
</head>
<body>
    <div class="header">
        <i class="iconfont confirmIcon" style="font-size: 40px">&#xe618;</i>
        <div class="headerCenter">
            <span>支付成功</span>
            <span class="wait">祝您用餐愉快，期待您的再次光临</span>
        </div>
    </div>
    <div class="main">
        @foreach($data['greens'] as $v)
            <div class="mainItem">
                <span class="foodName">{{$v['name']}}</span>
                <span class="foodNum">x{{$v['pivot']['num']}}</span>
                <span class="money">￥{{$v['price']}}</span>
            </div>
        @endforeach
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
            <span class="onSale">￥{{floatval($data['price'])-floatval($data['onsale_price'])}}</span>
        </div>
        <div class="totalBottom">
            <span class="totalLeft">参与优惠金额</span>
            <span class="totalMoney">￥{{$data['onsale_price']}}</span>
        </div>
    </div>
    <div class="orderDetail">
        <div class="orderDetailHeader">
            <span class="detailLeft">订单详情</span>
        </div>
        <div class="detailItem">
            <span class="detailLeft">订单编号</span>
            <span class="detailRight">{{$data['code']}}</span>
        </div>
        <div class="detailItem">
            <span class="detailLeft">下单时间</span>
            <span class="detailRight">{{$data['created_at']}}</span>
        </div>
        <div class="detailItem">
            <span class="detailLeft">消费总额</span>
            <span class="detailRight">￥{{$data['price']}}</span>
        </div>
        <div class="detailItem">
            <span class="detailLeft">实付</span>
            <span class="detailRight">￥{{floatval($data['price'])-floatval($data['onsale_price'])}}</span>
        </div>
    </div>
</body>
</html>