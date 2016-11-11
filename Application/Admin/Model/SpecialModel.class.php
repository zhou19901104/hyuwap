<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-11-9
 * Time: 上午11:02
 */

namespace Admin\Model;

use Think\Model;

class SpecialModel extends Model
{

    /**
     * 删除对应数据
     */
    protected function _before_delete($data, $options)
    {
        $special = D('Special');
        $spcon = D('Spcon');

        $info = $special->field('img_url,id')->where('id='.$data['where']['id'])->find();

        $infoMsg = $spcon->field('sp_id,content')->where('sp_id='.$data['where']['id'])->find();

        @unlink($info['img_url']);

        $arr = $this->xm_metch('/<img src="(.*)"/isU',$infoMsg['content']);

        for($i=0, $len = count($arr); $i < $len; $i++){
            //echo json_encode('.'.$arr[$i]);
            @unlink('.'.$arr[$i]);
        }

        $spcon->where(array('sp_id' => $data['where']['id']))->delete();

    }

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