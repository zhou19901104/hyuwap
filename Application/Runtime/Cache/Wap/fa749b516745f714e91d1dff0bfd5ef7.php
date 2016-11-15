<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($data["name"]); ?></title>
    <meta name="description" content="" />
    <meta name="keywords" content="<?php echo ($data["name"]); ?>" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>/base.css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>/zt.css">
    <style>
        .container .main-content img{
            width: 100%;
        }
    </style>
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
        <!--banner部分-->
    <!--    <div class="main-banner">
            <div class="banner-img">
                <ul>
                    <li><a href=""><img src="<?php echo C('IMG_URL');?>/banner.jpg" alt=""></a></li>
                </ul>
            </div>
        </div>-->
        <!--导航部分-->
        <div class="main-nav">
            <div class="nav-colnum">
                <ul>
                    <li><a href="<?php echo C('SITE_URL');?>"><img src="<?php echo C('IMG_URL');?>/nav-1.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>首页</p></a></li>
                    <li><a href="<?php echo U('Web/company');?>"><img src="<?php echo C('IMG_URL');?>/nav-2.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>品牌</p></a></li>
                    <li><a href="<?php echo C('SITE_URL');?>/#item-list"><img src="<?php echo C('IMG_URL');?>/nav-3.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>项目</p></a></li>
                    <li><a href="<?php echo U('Web/anli');?>"><img src="<?php echo C('IMG_URL');?>/nav-4.png"><img class="nav-shuxian" src="<?php echo C('IMG_URL');?>/nav-shuxian.png"><p>案例</p></a></li>
                    <li><a href="<?php echo U('Web/doctor');?>"><img src="<?php echo C('IMG_URL');?>/nav-5.png"><p>医生</p></a></li>
                </ul>
            </div>
        </div>


        <div class="main-content">
            <?php echo ($data["content"]); ?>
        </div>
        <!--联系方式-->
        <div class="content-code clearfix">
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


    </div>


    <!--footer部分-->
    <footer class="footer clearfix">
        <div class="footer-list">
            <ul>
                <li><a href="<?php echo C('SITE_URL');?>"><img src="<?php echo C('IMG_URL');?>/foot-1.png"><p>焕誉首页</p></a></li>
                <li><a href="tel:010-5729-0660"><img src="<?php echo C('IMG_URL');?>/foot-2.png"><p>拨打电话</p></a></li>
                <li><a href="<?php echo C('SHANG_WU_TONG');?>"><img src="<?php echo C('IMG_URL');?>/fqmx.png"></a></li>
                <li><a href="<?php echo C('SHANG_WU_TONG');?>"><img src="<?php echo C('IMG_URL');?>/foot-3.png"><p>在线客服</p></a></li>
                <li><a href="<?php echo U('Web/map');?>"><img src="<?php echo C('IMG_URL');?>/foot-4.png"><p>来院路线</p></a></li>
            </ul>
        </div>
    </footer>

</div>
</body>
<script type="text/javascript" src="<?php echo C('JS_URL');?>/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo C('JS_URL');?>/base.js"></script>
<script type="text/javascript" src="<?php echo C('JS_URL');?>/zt.js"></script>
</html>