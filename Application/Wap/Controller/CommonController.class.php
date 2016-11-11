<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-8-15
 * Time: 上午11:15
 */

namespace Wap\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function __construct()
    {

        parent::__construct();


        if(F('class_list') == ''){
            $class_list = M('Class')
                ->where('pid = 0')
                ->order('sort DESC')
                ->select();
            F('class_list', $class_list);
        }

        $class_list = F('class_list');

        if(F('nav_list') == ''){
            $nav_list = M('Nav')
                ->field('th_img_url,sort,id,link')
                ->order('sort ASC')
                ->select();
            F('nav_list', $nav_list);
        }

        $nav_list = F('nav_list');

        $this->assign('class_list', $class_list);
        $this->assign('nav_list', $nav_list);
    }

}
