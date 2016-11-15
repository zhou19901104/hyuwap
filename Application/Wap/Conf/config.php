<?php
return array(


    'CSS_URL' => C('SITE_URL').'/Public/Wap/css',
    'JS_URL' => C('SITE_URL').'/Public/Wap/js',
    'IMG_URL' => C('SITE_URL').'/Public/Wap/images',



    //"TMPL_TEMPLATE_SUFFIX" => ".html", //页面后缀

    'URL_ROUTER_ON'   => true,             //开启路由规则

    'URL_ROUTE_RULES' => array(

        'wz/:id\d' => 'Wap/Web/wz', //文章页面的路由匹配
        'zt/:id\d' => 'Wap/Web/zt',
        'xm/:id\d' => 'Wap/Web/xm'

    ),


    //'URL_HTML_SUFFIX' => 'html',
);
