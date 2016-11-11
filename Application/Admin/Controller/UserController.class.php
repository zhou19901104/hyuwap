<?php
/**
 *name:员工管理模块
 *date:2013-09-12
 *
 */

namespace Admin\Controller;

use Think\Model;
use Think\Page;

class UserController extends CommonController
{

   /**
    * 管理员列表
    */
   public function admin_list()
   {

         $user = D('User');

         $userData = $user->field('uid,username,create_time,login_ip,remark,status')->select();

         $count = $user->count();
         $this->assign('count', $count);
         $this->assign('userData', $userData);
         $this->display();// 输出模板

   }

   /**
    * 管理员添加
    */
   public function admin_add()
   {
      if(IS_POST){

         $user = D('User');

         if(!$data = $user->create()){
            $this->error($user->getError());
         }else{

            $data['create_time'] = time();
            $data['password'] = md5($data['password']);
            $data['status'] = 1;

            if($user->add($data)){
               $this->success('添加成功', U('User/admin_list'),2);
            }else{
               $this->error('添加失败', U('User/admin_list'),2);
            }
         }

      }else{
         $this->display();
      }

   }

   /**
    * 管理员修改
    */
   public function admin_edit()
   {
      $user = D('User');

      if(IS_POST){
         if(!$data = $user->create()){
            $this->error($user->getError());
         }else{

           if($data['password'] != ''){
             $data['password'] = md5($data['password']);
           }else{
              unset($data['password']);
           }
            //dump($data);die();
           if($user->save($data)){

              $this->success('修改成功', U('User/admin_list'),2);
           }else{
              $this->error('修改失败', U('User/admin_list'),2);
           }

         }

      }else{

         $id = I('get.id');

         $userData = $user->field('uid,username,password,status,remark,role_id,email')->where(array('uid' => $id))->find();
         $this->assign('userData', $userData);

         $this->display();
      }

   }

   /**
    * 管理员删除
    */
   public function admin_del()
   {
      $id = I('get.id');
      $user = D('User');

      if($user->delete($id)){

         $data = [
            'message' => '删除成功',
            'member' => 1
         ];
         echo json_encode($data);

      }else{
         $data = [
             'message' => '删除失败',
             'member' => 2
         ];
         echo json_encode($data);
      }

   }

   /**
    * 管理员停用
    */
   public function admin_stop()
   {
      $id = I('get.id');
      $user = D('User');

      if($user->where('uid='.$id)->setField('status', 0)){
         $data = [
             'message' => '账号停用',
         ];
         echo json_encode($data);
      }else{
         $data = [
             'message' => '停用失败',
         ];
         echo json_encode($data);
      }

   }

   /**
    * 管理员启用
    */
   public function admin_start()
   {
      $id = I('get.id');
      $user = D('User');

      if($user->where('uid='.$id)->setField('status', 1)){
         $data = [
             'message' => '账号启用',
         ];
         echo json_encode($data);
      }else{
         $data = [
             'message' => '启用失败',
         ];
         echo json_encode($data);
      }
   }

   public function add()
   {

      $um = M('users');
      $role = M('role')->select();
      $this->assign('cre', $cre);
      $this->assign('role', $role);
      if (isset($_POST['submit'])) {
         if ($_POST['username'] !== '' && $_POST['password'] !== '') {
            if ($_POST['username'] == 'admin' || $_POST['username'] == 'root' || $_POST['username'] == 'master') {
               $this->error('不能用admin,root,master做为账号!');
               exit();
            }
            $cre = $um->where('username = "' . $_POST['username'] . '"')->find();

            if ($cre > 1) {
               $this->error('账号重复，请重新输入');
            }

            $udata = $this->_post();
            $udata['password'] = md5($udata['password']);
            $udata['reg_time'] = time();
            $ure = $um->add($udata);
            if ($ure) {
               $mm = M('role_user');
               $data['uid'] = $ure;
               $data['role_id'] = $udata['role_id'];
               $data['user_id'] = $ure;
               $mre = $mm->add($data);
               if ($mre) {
                  $this->success('添加成功！', U('User/index'));
               } else {
                  $this->error('添加失败');
               }
            } else {
               $this->error('添加失败');
            }
         } else {
            $this->error('必须输入用户名或者密码！');
         }
      } else {
         $this->display();
      }
   }

   public function edit()
   {
      $id = intval($_GET['id']);
      $um = M('users');
      if ($_POST['submit']) {
         $data = I('post.');
         if ($_POST['password'] == '') {
            unset($data['password']);
         } else {
            $data['password'] = md5($data['password']);
         }
         $ure = $um->where('uid = "' . $_POST['uid'] . '"')->save($data);
         $ro = M('role_user');
         $ro->where('user_id = "' . $_POST['uid'] . '"')->save($data);
         //$cre = M('userinfo');
         //$chre = $cre->where('uid = "' . $_POST['uid'] . '"')->save($data);
         if ($ure) {
            $this->success('修改成功', U('User/index'));
         } else {
            $this->error('修改失败');
         }

      } else {
         //$cit = M('city');
         $role = M('role');
         $role_info = $role->select();
         //$cre = $cit->select();
         //$this->assign('cre', $cre);
         $ure = $um->where('uid = "' . $id . '"')->find();
         //$im = M('userinfo');
         //$ire = $im->where('uid = "' . $id . '"')->find();
         $valu = $ure;
        // $valu += $ire;

         $this->assign('valu', $valu);
         $this->assign('role', $role_info);

         $this->display();
      }
   }

   public function del()
   {
      $in = intval($_GET['id']);
      $um = M('users');
      //$im = M('userinfo');
      //$ire = $im->where('uid = "' . $in . '"')->delete();
      $re = $um->where('uid = "' . $in . '"')->delete();

      if ($re > 0) {
         $this->success('删除成功', U('User/index'));
      } else {
         $this->error('删除失败！');
      }
   }

   function furl($fi)
   {
      $url = '?s=/User/index/';
      if (count($fi) > 0) {
         foreach ($fi as $k => $v) {
            if ($k && $v) {

               $url = $url . $k . '/' . urlencode($v) . '/';
            }
         }
      }
      return $url;
   }

}