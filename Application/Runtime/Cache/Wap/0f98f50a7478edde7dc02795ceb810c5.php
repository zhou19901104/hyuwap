<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>北京焕誉医疗美容</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>/base.css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>/map.css">
</head>
<body>

<div class="container">
    <!--header-->
    <div class="header clearfix">
        <div class="header-box">
            <ul>
                <li><a><img src="<?php echo C('IMG_URL');?>/top-left.png"></a></li>
                <li><img src="<?php echo C('IMG_URL');?>/top-logo.png"></li>
                <li><a href="tel:010-5729-0660"><img src="<?php echo C('IMG_URL');?>/top-tel.png"></a></li>
            </ul>
        </div>
    </div>

    <!--主体内容-->
    <div class="main">

        <!--导航部分-->
        <div class="main-nav">
            <div class="nav-colnum">
                <ul>
                    <li><a href="<?php echo U('Web/index');?>"><img src="<?php echo C('IMG_URL');?>/nav-1.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>首页</p></a></li>
                    <li><a href="<?php echo U('Web/company');?>"><img src="<?php echo C('IMG_URL');?>/nav-2.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>品牌</p></a></li>
                    <li><a href="<?php echo U('Web/lists');?>"><img src="<?php echo C('IMG_URL');?>/nav-3.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>项目</p></a></li>
                    <li><a href="<?php echo U('Web/anli');?>"><img src="<?php echo C('IMG_URL');?>/nav-4.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>案例</p></a></li>
                    <li><a href="<?php echo U('Web/doctor');?>"><img src="<?php echo C('IMG_URL');?>/nav-5.png"><p>医生</p></a></li>
                </ul>
            </div>
        </div>
    </div>


<div class="container-map" style=":auto;height:320px;border:#ccc solid 1px;" id="dituContent"></div>

<div class="menthod-wrap">
    <p class="map-go">地图>来院路线</p>

    <ul class="route-map" id="route-map">
        <li class="show">公交路线</li>
        <li>地铁路线</li>
        <li>机场路线</li>
        <li>火车路线</li>
    </ul>

    <ul class="cont-map" id="cont-map">
        <li class="active">
            <p class="m-tit">公交路线<span>Bus Route</span></p>
            <p>乘坐【33路】、【79路】、【355路】、【360路】、【365路】、【425路】、【539路】、【611路】、【664路】、【992路】、【运通101快车】、【运通114线】、【运通118线】、【425快车】到（远大路东口）下车，沿远大路走530米，果蔬好超市对面。</p>
            <p class="phone">详情咨询：<a href="tel:010-5729-0660">010-5729-0660</a>,400-7667-000</p>
        </li>
        <li>
            <p class="m-tit">地铁路线<span>Metro Line</span></p>
            <p>乘坐【地铁10号线】，在【长春桥】下车(D2出口)直走1000米。</p>
            <p class="phone">详情咨询：<a href="tel:010-5729-0660">010-5729-0660</a>,400-7667-000</p>
        </li>
        <li>
            <p class="m-tit">首都国际机场路线<span>Airport Route</span></p>
            <p>T3航站楼站上车【机场线】到三元桥站下车，换乘地铁10号线，长春桥D2口出，直行1000m。即到北京焕誉医疗美容中心。</p>
            <p class="phone">详情咨询：<a href="tel:010-5729-0660">010-5729-0660</a>,400-7667-000</p>
        </li>
        <li>
            <p class="m-tit">北京站路线<span>Beijing Railway Station route</span></p>
            <p class="m-m">● 北京站路线：</p>
            <p>北京站上车，乘坐铁2号线（外环），朝阳门站换成地体6号线，慈寿寺站下车，换乘地铁10号线，长春桥站下车，D2口出，直行1000m即到北京焕誉医疗美容中心。</p>
            <p class="m-m">● 北京西站路线：</p>
            <p>北京西站上车，乘坐9号线，六里桥站下车，换乘地铁10号线，长春桥站下车，D2口出，直行1000m即到北京焕誉医疗美容中心。</p>
            <p class="m-m">● 北京南站路线：</p>
            <p>北京南站上车，乘坐地铁4号线，角门西站下车，换乘地铁10号线，长春桥站下车，D2口出，直行1000m即到北京焕誉医疗美容中心。</p>
            <p class="phone">详情咨询：<a href="tel:010-5729-0660">010-5729-0660</a>,400-7667-000</p>
        </li>
    </ul>
</div>


<!--联系方式-->
<div class="content-code clearfix" id="content-code">
    <div class="code-left fl">
        <p class="icon-1">焕誉医美</p>
        <hr width=10% size=4 color=#e6c88a />
        <p class="icon-2">联系我们 : <a href="tel:010-5729-0660"><i>010-5729-0660</i></a></p>
        <p>医院地址 : </p>
        <p class="icon-3">北京市海淀区远大路22号院11号楼底商</p>
    </div>
    <div class="code-right fr">
        <img src="<?php echo C('IMG_URL');?>/dibu-weixin.png" alt="">
    </div>
</div>

<!--footer部分-->
<footer id="footer" class="footer clearfix">
    <div class="footer-list">
        <ul>
            <li><a href="<?php echo U('Web/index');?>"><img src="<?php echo C('IMG_URL');?>/foot-1.png"><p>焕誉首页</p></a></li>
            <li><a href="tel:010-5729-0660"><img src="<?php echo C('IMG_URL');?>/foot-2.png"><p>拨打电话</p></a></li>
            <li><a href="<?php echo C('SHANG_WU_TONG');?>"><img src="<?php echo C('IMG_URL');?>/fqmx.png"></a></li>
            <li><a href="<?php echo C('SHANG_WU_TONG');?>"><img src="<?php echo C('IMG_URL');?>/foot-3.png"><p>在线客服</p></a></li>
            <li><a href="<?php echo U('Web/map');?>"><img src="<?php echo C('IMG_URL');?>/foot-4.png"><p>来院路线</p></a></li>
        </ul>
    </div>
</footer>
</div>
<script>
    window.onload = function(){
        /*路线切换*/
        var show = document.getElementById('route-map').getElementsByTagName('li');
        var active = document.getElementById('cont-map').getElementsByTagName('li');
        for(var i=0; i<show.length; i++){
            show[i].index = i;
            show[i].onclick = function(){
                for(var j=0; j<show.length; j++){
                    show[j].className = "";
                    active[j].className = "";
                }
                this.className = "show";
                active[this.index].className = "active";
            }
        }

        var content_code = document.getElementById('content-code');
        var foot = document.getElementById('footer');
        content_code.style.marginBottom = foot.offsetHeight + "px";
    }
</script>

<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }

    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(116.289136,39.963412);//定义一个中心点坐标
        map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }

    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }

    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
        var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
        map.addControl(ctrl_nav);
        //向地图中添加比例尺控件
        var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
        map.addControl(ctrl_sca);
    }

    //标注点数组
    var markerArr = [{title:"焕誉整形医院",content:"北京市海淀区远大路22号院11号楼一层二层",point:"116.289495|39.963264",isOpen:1,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
    ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
            var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
            var iw = createInfoWindow(i);
            var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
            marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                borderColor:"#808080",
                color:"#333",
                cursor:"pointer"
            });

            (function(){
                var index = i;
                var _iw = createInfoWindow(i);
                var _marker = marker;
                _marker.addEventListener("click",function(){
                    this.openInfoWindow(_iw);
                });
                _iw.addEventListener("open",function(){
                    _marker.getLabel().hide();
                })
                _iw.addEventListener("close",function(){
                    _marker.getLabel().show();
                })
                label.addEventListener("click",function(){
                    _marker.openInfoWindow(_iw);
                })
                if(!!json.isOpen){
                    label.hide();
                    _marker.openInfoWindow(_iw);
                }
            })()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }

    initMap();//创建和初始化地图
</script>

</body>
</html>