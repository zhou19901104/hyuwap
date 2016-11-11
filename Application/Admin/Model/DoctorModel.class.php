<?php

namespace  Admin\Model;

use Think\Model;

class DoctorModel extends Model
{
    protected $_validate = array(

        array('name', 'require', '医生姓名不能为空'),
        array('tech', 'require', '医生职称不能为空'),
        array('message', 'require', '医生文章不能为空'),
        array('ment_id', 'require', '医生部门不能为空'),

    );

    /**
     * 修改医生信息
     * @param $data
     * @param $options
     */
    protected function _before_update($data, $options)
    {

    }
    /**
     * 添加医生信息
     * @param $data
     * @param $options
     */
    protected function _before_add($data, $options)
    {

    }
    /**
     * 删除图片
     * @param $data
     * @param $options
     */
    protected function _before_delete($data, $options)
    {
        $msg = D('DoctorMsg');

        $info = $msg
                ->field('img_url,did')
                ->where('did=' . $data['where']['id'])
                ->find();
        @unlink($info['img_url']);
        $msg->where('did=' . $data['where']['id'])->delete();
    }

}
