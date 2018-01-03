<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>购物车</title>
</head>
<body>
<div class="header">
    <span class="menu">我的菜单</span>
    <div class="clear">
        <i class="iconfont">&#xe602;</i>
        <span>清空</span>
    </div>
</div>
<div class="main">
    @foreach($data as $k => $v)
        <div class="mainItem" key="{{$v['id']}}" count="{{$v['num']}}">
            <span class="foodName">{{$v['name']}}</span>
            <span class="money">{{$v['price']}}</span>
            <div class="mainItemCheck">
                <i class="iconfont" style="color: coral" onclick="GreenMin(this)">&#xe601;</i>
                <span>{{$v['num']}}</span>
                <i class="iconfont" style="color: coral;" onclick="GreenAdd(this)">&#xe652;</i>
            </div>
        </div>
    @endforeach
</div>
<div class="bottom">
    <div class="continueAdd" onclick="toMenu()">
        继续点菜
    </div>
    <div class="pay" onclick="toOrder()">
        下单(￥<span id="total">{{$total}}</span>)
    </div>
</div>
</body>
<script>
    let totalSpan = document.getElementById('total');
    let totalMoney = parseFloat(totalSpan.innerHTML);
    function GreenAdd (obj) {
        let mainItem = obj.parentNode.parentNode;
        let id = mainItem.getAttribute('key');
        let count = parseInt(mainItem.getAttribute('count'));
        let countSpan = mainItem.childNodes[5].childNodes[3];
        let money = parseFloat(mainItem.childNodes[3].innerHTML);
        let params = new URLSearchParams();
        params.append('id',id);
        params.append('count',++count);
        axios.post('{{URL::asset('cart/change')}}',params)
            .then(function (res) {
                if (res.data.code === 200) {
                    countSpan.innerHTML = count;
                    mainItem.setAttribute('count', count);
                    totalMoney+=money;
                    totalSpan.innerHTML = totalMoney.toFixed(2);
                }
            })
    }
    function GreenMin(obj) {
        let mainItem = obj.parentNode.parentNode;
        let id = mainItem.getAttribute('key');
        let count = parseInt(mainItem.getAttribute('count'));
        let countSpan = mainItem.childNodes[5].childNodes[3];
        let money = parseFloat(mainItem.childNodes[3].innerHTML);
        let params = new URLSearchParams();
        params.append('id',id);
        params.append('count',--count);
        axios.post('{{URL::asset('cart/change')}}',params)
            .then(function (res) {
                if (res.data.code === 200) {
                    countSpan.innerHTML = count;
                    mainItem.setAttribute('count', count);
                    totalMoney-=money;
                    totalSpan.innerHTML = totalMoney.toFixed(2);
                }
            })
    }
    function toMenu() {
        window.location.href = '{{route('index')}}'
    }
    function toOrder() {
        window.location.href = '{{route('order')}}'
    }
</script>
</html>