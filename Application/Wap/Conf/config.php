<?php
return array(


    'CSS_URL' => C('SITE_URL').'/Public/Wap/css',
    'JS_URL' => C('SITE_URL').'/Public/Wap/js',
    'IMG_URL' => C('SITE_URL').'/Public/Wap/images',

    'URL_ROUTER_ON'   => true,              //开启缓存

    'URL_ROUTE_RULES' => array(

        //'/wap/hyuxm' => array('Web/project_list'),

        'sp/slz' => array('Special/face'),
        'sp/tuom' => array('Special/gem'),

        'sp/xqxsyp' => array('Special/content', array('id' =>42 )),
        'sp/ywbls' => array('Special/content', array('id' =>38 )),
        'sp/zftc' => array('Special/content', array('id' =>37)),
        'sp/xzjf' => array('Special/content', array('id' =>39 )),
        'sp/jfcz' => array('Special/content', array('id' =>40 )),
        'sp/zflx' => array('Special/content', array('id' =>41)),
        'sp/xqxlb' => array('Special/content', array('id' =>36 )),
        'xm/xzjf' => array('Web/Content', array('id' => 125)),
        'xm/bcww' => array('Web/Content', array('id' => 168)),
        'xm/cgnf' => array('Web/Content', array('id' => 169)),
        'xm/qcd' => array('Web/Content', array('id' => 261)),
        'xm/xmxws' => array('Web/Content', array('id' => 258)),
        'xm/qzqtj' => array('Web/Content', array('id' => 259)),
        'xm/ztzftc' => array('Web/Content', array('id' => 178)),
        'xm/hl' => array('Web/Content', array('id' => 170)),
        'xm/botox' => array('Web/Content', array('id' => 171)),
        'xm/lnb' => array('Web/Content', array('id' => 175)),
        'xm/hhb' => array('Web/Content', array('id' => 172)),
        'xm/sb' => array('Web/Content', array('id' => 173)),
        'xm/qb' => array('Web/Content', array('id' => 174)),
        'xm/chxf' => array('Web/Content', array('id' => 274)),
        'xm/rby' => array('Web/Content', array('id' => 189)),
        'xm/alw' => array('Web/Content', array('id' => 190)),
        'xm/rl' => array('Web/Content', array('id' => 186)),
        'xm/yw' => array('Web/Content', array('id' => 185)),
        'xm/bsqyd' => array('Web/Content', array('id' => 191)),
        'xm/jw' => array('Web/Content', array('id' => 235)),
        'xm/ttw' => array('Web/Content', array('id' => 276)),
        'xm/yww' => array('Web/Content', array('id' => 237)),
        'xm/mjw' => array('Web/Content', array('id' => 238)),
        'xm/zjw' => array('Web/Content', array('id' => 240)),
        'xm/flw' => array('Web/Content', array('id' => 239)),
        'xm/lbsc' => array('Web/Content', array('id' => 241)),
        'xm/ttm' => array('Web/Content', array('id' => 249)),
        'xm/tym' => array('Web/Content', array('id' => 250)),
        'xm/tcm' => array('Web/Content', array('id' => 243)),
        'xm/tfjx' => array('Web/Content', array('id' => 248)),
        'xm/tsbm' => array('Web/Content', array('id' => 247)),
        'xm/ybxf' => array('Web/Content', array('id' => 266)),
        'xm/qyd' => array('Web/Content', array('id' => 194)),
        'xm/syp' => array('Web/Content', array('id' => 192)),
        'xm/kyj' => array('Web/Content', array('id' => 195)),
        'xm/sjxcjz' => array('Web/Content', array('id' => 196)),
        'xm/lbxf' => array('Web/Content', array('id' => 207)),
        'xm/xqxlb' => array('Web/Content', array('id' => 200)),
        'xm/bjzx' => array('Web/Content', array('id' => 201)),
        'xm/bysx' => array('Web/Content', array('id' => 202)),
        'xm/bxzzx' => array('Web/Content', array('id' => 204)),
        'xm/bjxjz' => array('Web/Content', array('id' => 206)),
        'xm/jtlx' => array('Web/Content', array('id' => 212)),
        'xm/xnjz' => array('Web/Content', array('id' => 213)),
        'xm/rtrrzx' => array('Web/Content', array('id' => 214)),
        'xm/ztzflx' => array('Web/Content', array('id' => 215)),
        'xm/smzx' => array('Web/Content', array('id' => 226)),
        'xm/mbjd' => array('Web/Content', array('id' => 228)),
        'xm/qmbmx' => array('Web/Content', array('id' => 231)),
        'xm/zmbmx' => array('Web/Content', array('id' => 233)),
        'xm/xmbmx' => array('Web/Content', array('id' => 234)),
        'xm/smbmx' => array('Web/Content', array('id' => 232)),

        'xm/list' => array('Web/project_list'),

        'zt/list' => array('Special/special_list'),



        'dc/list' => array('Web/doctor_list'),

        'doc/wz' => array('Web/doc_content', array('id' => 30)),
        'doc/ljf' => array('Web/doc_content', array('id' => 33)),
        'doc/wln' => array('Web/doc_content', array('id' => 34)),
        'doc/xyy' => array('Web/doc_content', array('id' => 35)),
        'doc/zh' => array('Web/doc_content', array('id' => 36)),
        'doc/zl' => array('Web/doc_content', array('id' => 37)),

        'xm/jqsl' => array('Special/jqsl'),


    ),

);
