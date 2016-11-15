<?php
return array(

        //'配置项'=>'配置值'
        'MODULE_ALLOW_LIST' => array('Wap', 'Admin'),

        'DEFAULT_MODULE'        =>  'Wap',  // 默认模块
        'DEFAULT_CONTROLLER'    =>  'Web', // 默认控制器名称
        'DEFAULT_ACTION'        =>  'index', // 默认操作名称

        'DB_TYPE'   => 'mysql',                     // 数据库类型
        'DB_HOST'   => 'localhost',             // 服务器地址
        'DB_NAME'   => 'hyuwap',                   // 数据库名
        'DB_USER'   => 'root',                      // 用户名
        'DB_PWD'    => 'HUANyu3306.',   // 密码
        'DB_PORT'   => 33306,                   // 端口
        'DB_PREFIX' => 'sd_',                       // 数据库表前缀

        //'URL_PATHINFO_FETCH' => 2,

        'SHOW_PAGE_TRACE'  =>  false,//开启页面跟踪信息

        //配置站点绝对路径
        'SITE_URL' => 'http://ab.hyuzx.com',

        'URL_MODEL'=>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：

        //'URL_PATHINFO_DEPR'     =>  '-',	// PATHINFO模式下，各参数之间的分割符号

        'UPLOAD_MAX_FILESIZE'=>'2M',//设置允许上传单个文件的大小

        'UPLOAD_ALLOW_EXT'=>array('jpg','jpeg','bmp','gif','png'),//设置允许上传文件的类型
        'URL_HTML_SUFFIX' => '',

        'SHANG_WU_TONG' => 'http://pkt.zoosnet.net/LR/Chatpre.aspx?id=PKT67204838&cid=1469000068684805339274&lng=cn&sid=1469000068684805339274&p=http%3A//hyuzx.com/&rf1=&rf2=&e=%25u6765%25u81EA%25u9996%25u9875%25u7684%25u5BF9%25u8BDD&bid=&d=1469000257113',

        'TEL' => 'tel:4007667000',

        'DATA_CACHE_TYPE'=>'file',
        'DATA_CACHE_TIME'=>'86400',

        'HYDESCRIPTION' => '北京焕誉医疗美容以“良心、诚心、精心”为核心价值观，遵循“用科技与美丽邂逅，以信誉让生命焕彩”的服务宗旨，开设美容皮肤科、美容外科、注射微整形、美容牙科四大整形美容项目，全方位打造中国整形美容旗舰品牌，为顾客提供安全先进的国际医学美容技术和全球同步医疗美容解决方案的国际连锁高端定制品牌,针对眼、鼻、脂肪移植有领先技术的专业医院,美丽热线 : 010-5729-0660 400-7667-000',
        'HYKEYWORDS' => '整形美容,北京焕誉,北京焕誉医疗美容,焕誉,王征,林健峯,焕誉整形外科,北京整形美容医院,自体脂肪移植填充,注射美容,抗衰老,高端私属定制整形',

);
