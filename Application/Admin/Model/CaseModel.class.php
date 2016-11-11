<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-9-14
 * Time: 上午10:17
 */

namespace Admin\Model;

use Think\Model;

class CaseModel extends Model
{
    protected $_validate = array(

    );

    /**
     * 删除案例对应的图片
     * @param $data
     * @param $options
     */
    protected function _before_delete($data, $options)
    {
        $info = D('Case')
                ->field('img_url,list_url,min_url,id')
                ->find($data['where']['id']);
        @unlink($info['img_url']);
        @unlink($info['list_url']);
        @unlink($info['min_url']);
    }


}