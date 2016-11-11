<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-10-31
 * Time: 下午2:03
 */

namespace Admin\Model;

use Think\Model;

class DoctorMentModel extends Model
{
    protected $_validate = array(

        array('class_name', 'require', '部门名称不能为空'),

        );

}