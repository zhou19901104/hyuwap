<?php
return array(

    //'配置项'=>'配置值'

    'USER_AUTH_ON' => true,  //开启权限
    'USER_AUTH_TYPE' => 1,  // 默认认证类型 1 登录认证 2 实时认证

    'USER_AUTH_KEY' => 'authId',  // 用户认证SESSION标记

    'ADMIN_AUTH_KEY' => 'administrator', //session里有这个管理员不需要认证

    'ADMINISTRATOR' => 'admin',

    'USER_AUTH_MODEL' => 'Users',  // 默认验证数据表模型

    'AUTH_PWD_ENCODER' => 'md5',  // 用户认证密码加密方式

    'USER_AUTH_GATEWAY' => '/Admin/Login/Index', // 默认认证网关
    'NOT_AUTH_MODULE' => 'Login', // 默认无需认证模块
    'NOT_AUTH_ACTION' => 'index', // 默认无需认证操作

    //'REQUIRE_AUTH_MODULE'=>'', // 默认需要认证模块
    //'REQUIRE_AUTH_ACTION'=>'', // 默认需要认证操作

    'GUEST_AUTH_ON' => false,    // 是否开启游客授权访问

    'GUEST_AUTH_ID' => 0,     // 游客的用户ID

    //'DB_LIKE_FIELDS'=>'title|remark',
    //'MODULE_ALLOW_LIST' => array('Web', 'Admin'),
    //'DEFAULT_MODULE' => 'Web',

    'RBAC_ROLE_TABLE' => 'sd_role',
    'RBAC_USER_TABLE' => 'sd_role_user',
    'RBAC_ACCESS_TABLE' => 'sd_access',
    'RBAC_NODE_TABLE' => 'sd_node',

    'SHOW_PAGE_TRACE' => false,

    'SPECIAL_USER' => 'administrator',




);
