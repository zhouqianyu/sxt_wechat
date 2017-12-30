<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/myOrder.css')}}">
    <title>我的订单</title>
</head>
<body>
<div class="header" id="header">
    @if($type===0)
        <span class="headerLeft current" value="0" onclick="tabSwitch(this)">全部</span>
    @else
        <span class="headerLeft" value="0" onclick="tabSwitch(this)">全部</span>
    @endif
    @if($type===1)
        <span class="current" value="1" onclick="tabSwitch(this)">已下单</span>
    @else
        <span value="1" onclick="tabSwitch(this)">已下单</span>
    @endif
    @if($type===2)
        <span class="current" value="2" onclick="tabSwitch(this)">已支付</span>
    @else
        <span value="2" onclick="tabSwitch(this)">已支付</span>
    @endif
    @if($type===3)
        <span class="headerRight current" value="3" onclick="tabSwitch(this)">已取消</span>
    @else
        <span class="headerRight" value="3" onclick="tabSwitch(this)">已取消</span>
    @endif

</div>
<div class="main">
    <div class="mainHeader">
        <span class="mainHeaderLeft">小台餐厅(正餐厅)</span>
    </div>
    @foreach($data as $v)
        <div class="mainBottom" key="{{$v['id']}}" onclick="detail(this)">
            <img src="../../public/img/restaurant.jpg" alt="">
            <div class="mainBottomCenter">
                <span>下单时间: {{$v['created_at']}}</span>
                <span>总价: {{$v['price']}}</span>
                <span>支付: 29.20</span>
            </div>
        </div>
    @endforeach
</div>
</body>
<script>
    function tabSwitch(obj) {
        let type = obj.getAttribute('value');
        window.location.href = '{{URL::asset('order/myOrder')}}?type='+type;
    }
    function detail(obj) {
        window.location.href = '{{URL::asset('order/detail')}}?id='+obj.getAttribute('key');
    }
</script>
</html>