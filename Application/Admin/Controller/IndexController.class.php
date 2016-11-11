<?php

namespace Admin\Controller;

use Think\Model;

class IndexController extends CommonController
{

    /**
     * 后台首页
     */
    public function index()
    {

        $this->display();
    }

    /**
     * 主页面
     */
    public function welcome()
    {
        //gd版本信息
        if (! function_exists ( "gd_info" )) {
            $gd = '不支持,无法处理图像';
        }
        if (function_exists ( gd_info )) {
            $gd = @gd_info ();
            $gd = $gd ["GD Version"];
            $gd ? '&nbsp; 版本：' . $gd : '';
        }

        $system = F('system');

        if($system == ''){
            $system = [
                '本机IP地址' => get_client_ip(),
                '操作系统' => PHP_OS,
                '主机名IP地址' => $_SERVER['SERVER_NAME'] . $_SERVER['SERVER_ADDR'] . ':'.$_SERVER['SERVER_PORT'],
                '运行环境' => $_SERVER['SERVER_SOFTWARE'], //服务器标识字符串
                'PHP运行方式' => php_sapi_name(),
                '程序目录' => $_SERVER['SCRIPT_FILENAME'],//当前执行脚本的绝对路径名
                '文档根目录' => $_SERVER['DOCUMENT_ROOT'] ,//文档根目录
                '通信协议的名称和版本' => $_SERVER['SERVER_PROTOCOL'], //请求页面时通信协议的名称和版本
                '上传附件限制' => ini_get('upload_max_filesize'),
                '执行时间限制' => ini_get('max_execution_time') . "秒",
                '当前服务器内存' => memory_get_usage(),
                '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
                '采集函数检测' => ini_get('allow_url_fopen') ? '支持' : '不支持',
                'GD库版本' => $gd,
            ];

            F('system', $system);
        }

        $this->assign('system', $system);
        $this->display();
    }


}