<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-9-16
 * Time: 上午11:04
 */

namespace Admin\Model;

use Think\Model;

class ContentModel extends Model
{

    /**
     * 检查文章数据完整性
     * @var array
     */
    protected $_validate = array(

        array('title', 'require', '文章标题不能为空'),
        array('title', '', '文章标题已经存在', 0, 'unique', 1),
        array('title', '1,50', '文章标题长度在1-50位之间', 1, 'length', 1),
        array('keyword', 'require', '文章关键词不能为空'),
        array('content', 'require', '文章内容不能为空'),
        array('cid', 'require','请选择文章类别')
    );

    /**
     * 删除数据
     * @param $data
     * @param $options
     */
    protected function _before_delete($data, $options)
    {
        $info = D('Content')->field('content,id')->find($data['where']['id']);

        $arr = $this->xm_metch('/<img src="(.*)"/isU', $info['content']);

        for($i=0, $len = count($arr); $i < $len; $i++){
            @unlink('.'.$arr[$i]);
        }
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