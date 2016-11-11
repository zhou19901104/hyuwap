<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-9-13
 * Time: 上午11:12
 */

namespace Admin\Model;

use Think\Model;

class NewsModel extends Model
{
    /**检测新闻的数据完整性
     * @var array
     */
    protected $_validate = array(

        array('title', 'require', '新闻标题不能为空'),
        array('content', 'require', '新闻内容不能为空'),
        array('description', 'require', '新闻简介不能为空'),
        array('description', '30,200', '新闻简介长度在30-200位之间', 1, 'length', 1),

    );

    /**
     * 删除新闻动态的图片
     * @param $data
     * @param $options
     */
    protected function _before_delete($data, $options)
    {

        $news = D('News');

        $info = $news->where(array('nid' => $data['where']['nid']))->find();

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