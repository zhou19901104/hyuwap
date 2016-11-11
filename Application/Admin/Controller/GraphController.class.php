<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-11-1
 * Time: 下午6:35
 */

namespace Admin\Controller;


class GraphController extends CommonController
{

    public function system()
    {
        $this->display();
    }
    /**
     * 折线图
     */
    public function linkchart()
    {

//        $curl = curl_init();
//
//        curl_setopt($curl,CURLOPT_URL, 'https://web.umeng.com/main.php?c=site&a=frame&siteid=1260684197#!/1478488719207/site/overview/1/1260684197/2016-11-07/2016-11-07');
//                                      //https://web.umeng.com/main.php?c=site&a=frame&siteid=1260684197#!/1478488719207/site/overview/1/1260684197/2016-11-07/2016-11-07
//
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        //执行命令
//        $data = curl_exec($curl);
//        //关闭URL请求
//        curl_close($curl);
//        //显示获得的数据
//        print_r($data);

        $this->display();
    }
    /**
     * 时间轴
     */
    public function timeline()
    {
        $this->display();
    }
    /**
     * 区域图
     */
    public function areachart()
    {
        $this->display();
    }
    /**
     * 柱状图
     */
    public function barchart()
    {
        $this->display();
    }
    /**
     * 饼状图
     */
    public function piechart()
    {
        $this->display();
    }

}