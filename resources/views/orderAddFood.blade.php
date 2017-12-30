<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/orderSubmitted.css">
    <link rel="stylesheet" href="../../public/css/iconfont.css">
    <title>点餐下单</title>
</head>
<body>
<div class="header">
    <i class="iconfont confirmIcon" style="font-size: 40px">&#xe618;</i>
    <div class="headerCenter">
        <span>加菜待处理</span>
        <span class="wait">请耐心等待服务员帮你下单</span>
    </div>
</div>
<div class="main">
    <div class="mainHeader">
        <span>小台餐厅(青山店)</span>
        <span class="table">桌号</span>
        <span class="tableNum">A02</span>
    </div>
    <div class="mainCenter">
        @if(isset($detail))
            @foreach($data['greens'] as $v)
                <div class="mainItem">
                    <span class="foodName">{{$v['name']}}</span>
                    <span class="foodNum">x{{$v['pivot']['num']}}</span>
                    <span class="money">￥{{$v['price']}}</span>
                </div>
            @endforeach
        @else
            @foreach($data as $v)
                <div class="mainItem">
                    <span class="foodName">{{$v['name']}}</span>
                    <span class="foodNum">x{{$v['num']}}</span>
                    <span class="money">￥{{$v['price']}}</span>
                </div>
            @endforeach
        @endif
    </div>
    <div class="totalContainer">
        <div class="totalHeader">
            <span class="totalLeft">合计</span>
            <span class="totalMoney">￥{{$total}}</span>
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
    <div class="bottom">
        <div class="continueAdd" onclick="toAdd()">
            加菜
        </div>
        <div class="pay" onclick="toSubmit({{$id}})">
            去结算
        </div>
    </div>
</div>
</body>
<script>
    function toSubmit(id) {
        window.location.href = '{{URL::asset('order/submit')}}?id=' + id;
    }

    function toAdd() {
        window.location.href = '{{route('index')}}';
    }
</script>
</html>