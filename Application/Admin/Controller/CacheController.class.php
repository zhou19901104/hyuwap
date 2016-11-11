<?php
/**
 * @name    缓存模块
 *
 */

namespace Admin\Controller;


class CacheController extends CommonController
{

    public function index()
    {

//        $caches = array(
//
//            "HomeCache" => array("name" => "网站前台缓存文件", "path" => WEB_ROOT . "/Cache/Home/"),
//            "AdminCache" => array("name" => "网站后台缓存文件", "path" => WEB_ROOT . "/Cache/Admin/"),
//            "WebData" => array("name" => "网站数据库字段缓存文件", "path" => WEB_ROOT . "/Data/"),
//            "LogTemp" => array("name" => "日志缓存文件", "path" => WEB_ROOT . "/Logs/"),
//            "AdminTemp" => array("name" => "网站后台临时缓存文件", "path" => WEB_ROOT . "/Temp"),
//            "CronTemp" => array("name" => "计划任务~crons.php缓存文件", "path" => WEB_ROOT . "/~crons.php")
//
//        );
//
//        $this->assign("caches", $caches);

        //$this->display();
    }

    // 删除全部核心缓存
    public function delCore()
    {
        import("ORG.Io.Dir");
        $dir = new Dir;
        @unlink('./Temp/~runtime.php');        //删除主编译缓存文件
        @unlink('./Temp/~crons.php');        //删除计划任务缓存文件
        @unlink('./Temp/cron.lock');        //删除计划任务执行锁定文件
        if (is_dir('./Temp/Data')) {
            $dir->delDir('./Temp/Data');
        }
        if (is_dir('./Temp/Temp')) {
            $dir->delDir('./Temp/Temp');
        }
        if (is_dir('./Temp/Cache')) {
            $dir->delDir('./Temp/Cache');
        }
        if (is_dir('./Temp/Logs')) {
            $dir->delDir('./Temp/Logs');
        }
        $this->success('清除成功');
    }

}