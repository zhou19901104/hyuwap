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
        $casecon = D('Casecon');

        $info = $casecon->field('content,ca_id')->where(array('ca_id' => $data['where']['id']))->find();

        $arr = $this->xm_metch('/<img src="(.*)"/isU',$info['content']);

        for($i=0, $len = count($arr); $i < $len; $i++){
           // echo json_encode($arr[$i]);
            @unlink('.'.$arr[$i]);
        }
        $casecon->where(array('ca_id' => $data['where']['id']))->delete();
    }

    /**
     * 匹配案例对应的图片
     * @param $parame
     * @param $str
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