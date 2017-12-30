<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/index.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>小台餐厅 青山店</title>
</head>
<body>
    <div class="indexContainer">
        <div class="header">
            <img src="{{URL::asset('img/restaurant.jpg')}}" alt="" class="restaurant">
            <span class="restaurantName">小台餐厅 青山店</span>
            <hr style="width: 90%"/>
            <span class="promotion">
                <i class="iconfont">&#xe60e;</i>
                满100减20
            </span>
        </div>
        <div class="main">
            <div class="mainLeft" id="mainLeft">
                <span type="1">冷菜</span>
                <span type="2">酒水</span>
                <span type="3">热菜</span>
                <span type="4">小吃</span>
                <span type="5">其他</span>
            </div>
            <div class="mainRight">
                <div class="mainRightTop">
                    <span>
                        @switch($type)
                            @case(1) 冷菜 @break
                            @case(2) 酒水 @break
                            @case(3) 热菜 @break
                            @case(4) 小吃 @break
                            @case(5) 其他
                        @endswitch
                    </span>
                </div>
                @foreach($data as $v)
                    <div class="mainItem" key="{{$v['id']}}" count="{{$v['count']}}" name="green">
                        <img src="{{$v['pic_url']}}" alt="" style="width: 80px; height: 80px">
                        <div class="mainItemCenter">
                            <span>{{$v['name']}}</span>
                            <span class="money">￥{{$v['price']}}</span>
                        </div>
                        <div class="mainItemRight hidden">
                            <div class="mainItemCheck">
                                <i class="iconfont" style="color: coral" onclick="GreenMin(this)">&#xe601;</i>
                                <span>{{$v['count']}}</span>
                                <i class="iconfont" style="color: coral;" onclick="GreenAdd(this)">&#xe652;</i>
                            </div>
                        </div>
                        <div class="mainItemRight">
                            <div class="rightAdd">
                                <i class="iconfont rightAddIcon" style="font-size: 15px" onclick="GreenAdd(this)">&#xe652;</i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bottom">
            <div class="cartBtn">
                <i class="iconfont cartIcon" style="font-size: 25px">&#xe600;</i>
            </div>
            <div class="cartNum">
                <span id="cartNum">{{$cartCount?$cartCount:0}}</span>
            </div>
            <!--<div class="cartTip">-->
                <!--<span>购物车为空</span>-->
            <!--</div>-->
            <div class="cartTipNotEmpty" onclick="toCart()">
                <span>选好了</span>
            </div>
        </div>
    </div>
</body>
<script>
    let leftBar = document.getElementById('mainLeft').childNodes;
    leftBar.forEach(function (item) {
        item.onclick = function () {
            let type = this.getAttribute('type');
            window.location.href = '{{URL::asset('index')}}?type='+type;
        }
    });
    leftBar[ '{{$type*2-1}}' ].className = 'current';
    let cart = document.getElementById('cartNum');
    let greenList = document.getElementsByName('green');
    greenList.forEach(function (item) {
        let count = item.getAttribute('count');
        if (count > 0){
            item.childNodes[5].className = 'mainItemRight';
            item.childNodes[7].className = 'hidden';
        }
        else {
            item.childNodes[5].className = 'hidden';
            item.childNodes[7].className = 'mainItemRight';
        }
    });
    function GreenAdd (obj) {
        let mainItem = obj.parentNode.parentNode.parentNode;
        let id = mainItem.getAttribute('key');
        let count = parseInt(mainItem.getAttribute('count'));
        let countSpan = mainItem.childNodes[5].childNodes[1].childNodes[3];
        let params = new URLSearchParams();
        params.append('id',id);
        params.append('count',++count);
        axios.post('{{URL::asset('cart/change')}}',params)
            .then(function (res) {
                if (res.data.code === 200) {
                    if (parseInt(count) === 1) {
                        mainItem.childNodes[5].className = 'mainItemRight';
                        mainItem.childNodes[7].className = 'hidden';
                    }
                    countSpan.innerHTML = count;
                    mainItem.setAttribute('count', count);
                    let cartNum = parseInt(cart.innerHTML);
                    cart.innerHTML = ++cartNum;
                }
            })
    }
    function GreenMin(obj) {
        let mainItem = obj.parentNode.parentNode.parentNode;
        let count = parseInt(mainItem.getAttribute('count'));
        let id = mainItem.getAttribute('key');
        let countSpan = mainItem.childNodes[5].childNodes[1].childNodes[3];
        let params = new URLSearchParams();
        params.append('id',id);
        params.append('count',--count);
        axios.post('{{URL::asset('cart/change')}}',params)
            .then(function (res) {
                if (res.data.code === 200) {
                    if (parseInt(count) === 0) {
                        mainItem.childNodes[5].className = 'hidden';
                        mainItem.childNodes[7].className = 'mainItemRight';
                    }
                    countSpan.innerHTML = count;
                    mainItem.setAttribute('count', count);
                    let cartNum = parseInt(cart.innerHTML);
                    cart.innerHTML = --cartNum;
                }
            })
    }
    function toCart() {
        window.location.href = '{{route('cart')}}';
    }
</script>
</html>