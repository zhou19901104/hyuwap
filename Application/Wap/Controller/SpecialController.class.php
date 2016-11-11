<?php

namespace Wap\Controller;


class SpecialController extends CommonController
{
           public function _empty()
    {
        $this->display('Empty/index');
    }
    public function special_list()
    {

        $special_info = M('Special')
                                    ->where(array('pid' =>0, 'active' => 1))
                                    ->select();
                                    // dump($special_info);die();
         $sp_id = $special_info[0]['id'];
         $this->assign('sp_id', $sp_id);
        $this->assign('special_info', $special_info);
        $this->display();
    }
    //内容展示
    public function content()
    {
        $id = I('get.id');
        $info = M('Spcontent')
            ->field('content,id')
            ->where(array('id' => $id))
            ->find();
        $this->assign('info', $info);
        $this->display();
    }
    //栏目列表页
    public function special_info()
    {
        $sp_id = I('get.id');

        $data = M('Special')
                    ->alias('s')
                    ->field('s.id,s.active,s.pid,c.sp_link,c.sp_id,c.id as cid,c.sp_img,c.sp_show')
                    ->join('__SPCONTENT__ as c on  c.sp_id = s.id ')
                    ->where(array('c.sp_id' => $sp_id, 'c.sp_show' =>1))
                    ->select();

        $this->ajaxReturn($data);

    }
    //项目列表
    public function project_list()
    {
        $id = I('get.id');
        if ($id == '') {
            $id = 121;
        }

        $class_info = M('class')->where('class_name = "焕誉项目"')->find();
        $left_list = M('class')->where('pid = "' . $class_info['id'] . '"')->select();
        $this->assign('left_list', $left_list);

        $right_list = M('class')->where('pid = "' . $id . '"')->select();
        $this->assign('right_list', $right_list);

        $this->assign('id', $id);
        $this->display();
    }

    public function class_edit()
    {
        $special = D('Special');
        $data = $special->create();

        $info = $special->where(array('id' => $data['id']))->select();


    }

    public function face()
    {
        $data = [
            'title' => '瘦脸针',
        ];
        $this->assign('data', $data);
        $this->display();
    }
        public function gem()
    {
        $data = [
            'title' => '双宝石脱毛',
        ];
        $this->assign('data', $data);
        $this->display();
    }
        public function miracle()
    {
        $data = [
            'title' => '媚蕊蔻',
        ];
        $this->assign('data', $data);
        $this->display();
    }
        public function jtubes()
    {
        $data = [
            'title' => '丰果冻唇',
        ];
        $this->assign('data', $data);
        $this->display();
    }
        public function zhongqiu()
    {
        $data = [
            'title' => '仲秋活动',
        ];
        $this->assign('data', $data);
        $this->display();
    }

    public function jqsl()
    {
        $this->display();
    }
    public function xz()
    {
        $this->display();
    }

}



























