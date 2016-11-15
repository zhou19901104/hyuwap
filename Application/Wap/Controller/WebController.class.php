<?php

namespace Wap\Controller;

class WebController extends CommonController
{

   /**
    * 网站主页
    */
   public function index()
   {
      //title数据
      $top = array(
       'title' => '北京焕誉医疗美容',
      );
      $this->assign('top', $top);

      //分类项目数据
      $cate = D('Category');
      $cateData = $cate->field('id,pid,cate_name,sort,abbob,img_url')->where(array('pid' => 0))->order('sort ASC')->limit(8)->select();

      $this->assign('cateData', $cateData);
      $this->display();
   }

   //项目列表
   public function lists()
   {
      $this->display();
   }

   /**
    * 项目展示
    */
   public function xm()
   {
      $id = I('get.id');
      $cate = D('Category');
      //查询id对应的分类信息
      $infoData = $cate->field('id,img_url,cate_name')->where(array('id' => $id))->find();

      //查询子分类下的所有项目
      $cateData = $cate->field('id,pid,cate_name,img_url,abbob,sort')->where(array('pid' => $id))->order('sort ASC')->select();

      //通过分类名称,查询子分类对应的专题项目
      $spcate = D('Cate');
      $info = $spcate->field('cate_name,id')->where(array('cate_name' => $infoData['cate_name']))->find();

      //递归出所有子分类 Cate
      $ztData = $spcate->field('img_url,id,pid')->where(array('pid' => $info['id']))->select();

      $this->assign('ztData', $ztData);
      $this->assign('infoData', $infoData);
      $this->assign('cateData', $cateData);
      $this->display();
   }
   /**
    * 文章展示
    */
   public function wz()
   {
      $id = I('get.id');

      $content = D('Content');
      $data = $content->field('keyword,content,title,id')->where(array('cid' => $id))->find();
      $this->assign('data', $data);
      $this->display();
   }

   /**
    * 专题列表
    */
   public function zt()
   {
      $special = D('Special');
      $spcon = D('Spcon');
      $id = I('get.id');

      $data = $special
               ->alias('s')
               ->field('s.id,s.name,s.pid,c.content,c.sp_id')
               ->join('__SPCON__ c on s.id=c.sp_id')
               ->where('s.pid='.$id)
               ->find();

      //dump(explode('<p>', $data['content']));

      //匹配p字段中的内容
      $dataMsg = $this->xm_metch('/<p>(.*)<\/p>/isU',$data['content']);
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
      $this->display();
   }
   //医生列表
   public function doctor()
   {
      $this->display();
   }

   /**
    * 医生详情
    */
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

   /**
    * 案例页
    */
   public function anli()
   {
      $this->display();
   }

   /**
    * 关于焕誉文章页
    */
   public function company()
   {
      $news = D('News');
      $data = $news->field('nid,content,title,keyword,description')->limit(1)->find();

      $this->assign('data', $data);
      $this->display();
   }

   /**
    * 项目二级栏目页
    */
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

   /**
    * 项目详情页
    */
   public function content()
   {
      $this->display();
   }

   /**
    * 医生详情页
    */
   public function detail()
   {
      $this->display();
   }

   /**
    * 来院地图开发
    */
   public function map()
   {
      $top = array(
        'title' => '焕誉医疗美容地址',
      );

      $this->assign('top', $top);
      $this->display();
   }

   /**
    * 空操作方法
    */
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



























