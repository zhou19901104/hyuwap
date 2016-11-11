<?php

namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{

   //自动验证
   protected $_validate = array(
     array('username', 'require', '名称必须填写！', 1, '', 3),
     array('email', 'require', '邮箱已存在！', 1, '', 3),
   );

   // 获取所有节点信息
   public function getAllUser($where = '', $order = 'sort DESC')
   {
      return $this->where($where)->order($order)->select();
   }

   // 获取单个节点信息
   public function getNode($where = '', $field = '*')
   {
      return $this->field($field)->where($where)->find();
   }

   // 删除节点
   public function delNode($where)
   {
      if ($where) {
         return $this->where($where)->delete();
      } else {
         return false;
      }
   }

   // 更新节点
   public function upNode($data)
   {
      if ($data) {
         return $this->save($data);
      } else {
         return false;
      }
   }

   // 子节点
   public function childNode($id)
   {
      return $this->where(array('pid' => $id))->select();
   }

   //完成用户登录
   public function checklogin($username, $password)
   {
      //接收传递的用户名和密码
      //思路根据用户名查找出用户的信息，输出的密码和数据库的中的密码进行匹配
      $info = $this
              ->field('uid,username,password,status,remark')
              ->where("username='$username'")
              ->find();

      if ($info) {
         //说明该用户存在，
         //判断该用户是否激活，如果没有激活则禁止登录
         if ($info['status'] == 0) {
            $this->error = '该用户没有激活,请去激活后登录';
            return false;
         }

         //验证密码是否合法
         if ($info['password'] == $password) {
            //已经登录成功
            session('username', $username);
            session('uid', $info['uid']);
            return true;
         }
      }
      $this->error = '用户名或密码错误';
      return false;
   }


}