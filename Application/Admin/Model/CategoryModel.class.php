<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-10-18
 * Time: 下午1:57
 */

namespace Admin\Model;

use Think\Model;

class CategoryModel extends Model
{

    /**
     * 检查分类数据完整性
     * @var array
     */
    protected $_validate = array(

        array('abbob', 'require', '分类别名不能为空'),
        array('cate_name', 'require', '分类名称不能为空')
    );

    /**
     * 删除对应的文章
     * @param $data
     * @param $options
     */
    protected function _before_delete($data, $options)
    {
        $content = D('Content');
        $load = $content->field('img_url')->where(array('cid' => $data['where']['id']))->find();
        @unlink($load['img_url']);
        $content->where(array('cid' => $data['where']['id']))->delete() ? true :false;
    }

}