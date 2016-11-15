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
        array('cate_name', 'require', '分类名称不能为空'),
        array('abbob','','分类名称缩写已经存在！,请重新填写',0,'unique',1),
        array('cate_name','','分类名称已经存在！,请重新填写',0,'unique',1),
    );

    /**
     * 删除对应的文章
     * @param $data
     * @param $options
     */
    protected function _before_delete($data, $options)
    {
/*        $content = M('Content');

        $info = $content->field('content,cid')->where(array('cid' => $data['where']['id']))->find();

        $arr = $this->xm_metch('/<img src="(.*)"/isU', $info['content']);
        //删除对应图片
        for($i=0, $len = count($arr); $i < $len; $i++){
            //echo json_encode($arr[$i]);
            @unlink('.'.$arr[$i]);
        }
        $content->where(array('cid' => $data['where']['id']))->delete();*/

    }

    /**
     * @param $parame 匹配规则
     * @param $str 匹配字符串
     * @return bool
     */
    public function xm_metch($parame, $str)
    {
        //匹配所有字段
        $arr = [];

        if(preg_match_all($parame, $str, $arr)){

            return $arr[1];
        }else{
            return false;
        }
    }

}