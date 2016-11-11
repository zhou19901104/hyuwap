<?php

namespace Wap\Controller;

class WebController extends CommonController
{

   //主页
   public function index()
   {

//      $top = array(
//        'title' => '北京焕誉医疗美容',
//      );
//
//      $this->assign('top', $top);
//
//      $banner_list = M('banner')        //轮播图
//         ->field('id,th_img_url,bg_img_url,sort,category')
//         ->where(array('category' => 1))
//         ->order('sort desc')
//         ->select();
//
//      $sp_show = M('Spcontent')
//        ->field('sp_img,sp_link,sp_show,sp_sort')
//        ->where(array('sp_show' => 1))
//        ->order('sp_sort DESC')
//        ->select();
//
//      $this->assign('banner_list', $banner_list);
//      $this->assign('sp_show', $sp_show);

      $this->display();
   }

   //项目列表
   public function lists()
   {
//      $top = array(
//        'title' => '焕誉项目',
//      );
//      $this->assign('top', $top);
//
//      $class_info = M('class')->where('class_name = "焕誉项目"')->find();
//
//
//      $left_list = M('class')    //查询焕誉项目的子栏目
//         ->field('class_name,id,th_img_url,sort')
//         ->where('pid = "' . $class_info['id'] . '"')
//         ->order('sort DESC')
//         ->select();
//      //dump($left_list);die();
//      $one_id = $left_list[0]['id']; //排序第一的id 方便ajax第一次调用
//      $this->assign('one_id', $one_id);
//      $this->assign('left_list', $left_list);
      $this->display();
   }
   /**
    * 项目展示
    */
   public function xm()
   {
      $spcon = D('Spcon');

      $data = $spcon->where('id=44')->find();

      //dump(explode('<p>', $data['content']));

      //匹配p字段中的内容
/*      $dataMsg = $this->xm_metch('/<p>(.*)<\/p>/isU',$data['content']);
      //空字符串 p br
      $strMsg = "<p><br/></p>";
      foreach($dataMsg as $key => $val ){
         //echo $val;
         if($val == $strMsg){
            //删除匹配到的空行
            unset($dataMsg[$key]);
         }
      }

      $data['content'] = implode('',$dataMsg);
      $this->assign('data', $data);*/


      dump($data['content']);

      $dataMsg = $this->xm_metch('/<img src="(.*)"/isU',$data['content']);


      foreach($dataMsg as $key=>$val){
         dump($val);
      }
      dump($dataMsg);
      //空字符串 p br
      $strMsg = "<p><br/></p>";
      foreach($dataMsg as $key => $val ){
         //echo $val;
         if($val == $strMsg){
            //删除匹配到的空行
            unset($dataMsg[$key]);
         }
      }

      $data['content'] = implode('',$dataMsg);
      $this->assign('data', $data);

      die();


      $this->display();
   }

   //医生列表
   public function doctor()
   {
//      $top = array(
//        'title' => '焕誉医生',
//      );
//
//      $this->assign('top', $top);
//      $dor_list = M('doctor_class')
//        ->order('sort desc')
//        ->select();
//
//      $dor_id = $dor_list[0]['id'];
//      $this->assign('dor_id', $dor_id);
//      $this->assign('dor_list', $dor_list);
      $this->display();
   }

   //医生详情
   public function doctor_info()
   {
      $id = I('get.id');
      $data = M('doctor')
        ->alias('d')
        ->field('d.id,d.img_url,abbob')
        ->where(array('cid' => $id))
        ->select();
      echo $this->ajaxReturn($data);
   }

   //案例页
   public function anli()
   {
//      $top = array(
//        'title' => '焕誉案例',
//      );
//      $this->assign('top', $top);
//
//      $anli_list = M('Case')
//        ->field('sort,th_img_url,id,abbob')
//        ->limit('0,6')
//        ->order('sort DESC')
//        ->select();
//      $this->assign('anli_list', $anli_list);

      $this->display();
   }

   //关于焕誉文章页
   public function company()
   {
//      $top = array(
//        'title' => '焕誉首页',
//      );
//      $this->assign('top', $top);
//      $info = M('Content')
//        ->field('content')
//        ->where(array('cid' => '116'))
//        ->find();
//      $this->assign('info', $info);
      $this->display();
   }

   //项目二级栏目页
   public function project_right()
   {
      $id = $_GET['id'];
      $class_right = M('Class')
        ->field('class_name,id,pid,sort,abbob')
        ->where(array('pid' => $id))
        ->order('sort desc')
        ->select();
      echo $this->ajaxReturn($class_right);
   }

   //项目详情页
   public function content()
   {
//      $top = array(
//        'title' => '项目详情',
//      );
//      $this->assign('top', $top);
//      $id = I('get.id');
//      $info = M('content')
//        ->field('cid,content')
//        ->where(array('cid' => $id))
//        ->find();
//      $doctor_info = M('Doctor')//医生详情
//      ->field('name,img_url,zhicheng,id')
//        ->limit('0,3')
//        ->select();
//      $this->assign('info', $info);
//      $this->assign('doctor_info', $doctor_info);
      $this->display();
   }

   /**
    * 医生详情页
    */
   public function detail()
   {
//      $top = array(
//        'title' => '医生详情',
//      );
//      $this->assign('top', $top);
//      $id = I('get.id');
//      $data = M('doctor')
//        ->alias('d')
//        ->field('d.img_url,d.index_zhu,d.id')
//        ->where(array('id' => $id))
//        ->find();
//      //dump($data);
//      $this->assign('data', $data);
      $this->display();
   }

   //来院地图开发
   public function map()
   {
      $top = array(
        'title' => '焕誉医疗美容地址',
      );
      $this->assign('top', $top);
      
      $this->display();
   }
     //空操作方法
   public function _empty()
   {
      $this->display('Empty/index');
   }

   /*
    * 匹配项目页空的p和br字段,并删除
    *
    */

   protected function xm_metch($parame, $str)
   {
      //匹配所有字段
      if(preg_match_all($parame, $str, $arr)){
         return $arr[1];
      }else{
         return false;
      }

   }



}



























