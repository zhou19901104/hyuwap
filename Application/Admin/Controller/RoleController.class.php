<?php
/**
 * 后台用户权限设置
 *  组 访问权限
 */

namespace Admin\Controller;

use Think\Page;

class RoleController extends CommonController
{

   /*
    * 角色管理
    */
   public function admin_role()
   {
      //import('ORG.Util.Page');// 导入分页类
//      $role = D('Role')->getAllRole();
//      $map = array();
//      $UserDB = D('User');
//      $count = $UserDB->where($map)->count();
//      $Page = new Page($count);// 实例化分页类 传入总记录数
//      // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
//      $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;
//      $show = $Page->show();// 分页显示输出
//      $this->assign('list', $role);
//      $this->assign('page', $show);// 赋值分页输出

      $role = D('Role');

      $roleData = $role->field('id,name,pid,remark')->select();

      $this->assign('roleData', $roleData);

      $this->display();
   }

   /**
    * 角色添加
    */
   public function admin_role_add()
   {

      if(IS_POST){
         $data = I('post.');

         if($data['one'] == '' || $data['two'] ==''){

            $this->error('父级分类必须选择');
         }else{
            $role = D('Role');

            if($insert_id = $role->add($data)){

               $access = D('Access');


               $this->success('添加成功', U('Home/Role/admin_role_add'),2);
            }else{
               $this->error('添加失败', U('Home/Role/admin_role_add'),2);
            }

         }

      }else{
         $node = D('Node');
         $nodeData = $node->field('id,name,status,pid,level')->where(array('pid' => 0,'status' => 1))->select();

         for($i=0; $i < count($nodeData); $i++){

            $nodeData[$i]['oneData'] = $node->field('id,name,status,pid,level')->where('pid =' .$nodeData[$i]['id'])->select();

            for($k = 0; $k < count($nodeData[$i]['oneData']); $k++){
               $nodeData[$i]['oneData'][$k]['twoData'] = $node->field('id,name,status,pid,level,title')->where('pid =' .$nodeData[$i]['oneData'][$k]['id'])->select();
            }
         }
         $this->assign('nodeData', $nodeData);

         $this->display();
      }

   }




   // 添加用户
   public function add()
   {
      $UserDB = D("Admin");
      if (isset($_POST['dosubmit'])) {

         $password = $_POST['password'];
         $repassword = $_POST['repassword'];
         if (empty($password) || empty($repassword)) {
            $this->error('密码必须！');
         }
         if ($password != $repassword) {
            $this->error('两次输入密码不一致！');
         }

         //根据表单提交的POST数据创建数据对象
         if ($UserDB->create()) {
            $user_id = $UserDB->add();
            if ($user_id) {
               $data['user_id'] = $user_id;
               $data['role_id'] = $_POST['role'];
               if (M("RoleUser")->data($data)->add()) {
                  $this->assign("jumpUrl", U('/Admin/Role/index'));
                  $this->success('添加成功！');
               } else {
                  $this->error('用户添加成功,但角色对应关系添加失败!');
               }
            } else {
               $this->error('添加失败!');
            }
         } else {
            $this->error($UserDB->getError());
         }
      } else {
         $role = D('Role')->getAllRole(array('status' => 1), 'sort DESC');
         $this->assign('role', $role);
         $this->assign('tpltitle', '添加');
         $this->display();
      }
   }

   // 编辑用户
   public function edit()
   {
      $UserDB = D("Admin");
      // $this->assign('waitSecond','500');
      if (isset($_POST['dosubmit'])) {
         $password = $_POST['password'];
         $repassword = $_POST['repassword'];
         if (!empty($password) || !empty($repassword)) {
            if ($password != $repassword) {
               $this->error('两次输入密码不一致！');
            }
            $_POST['password'] = md5($password);
         }

         if (empty($password) && empty($repassword)) unset($_POST['password']);   //不填写密码不修改

         //根据表单提交的POST数据创建数据对象

         if ($UserDB->create()) {

            if ($UserDB->save()) {
               $where['user_id'] = $_POST['user_id'];
               $data['role_id'] = $_POST['role'];
               M("RoleUser")->where($where)->save($data);
               $this->assign("jumpUrl", U('/Admin/Role/index'));
               $this->success('编辑成功！');
            } else {
               $this->error('编辑失败!');
            }
         } else {
            $this->error($UserDB->getError());
         }
      } else {
         $id = I('get.id');
         if (!$id) $this->error('参数错误!');
         $role = D('Role')->getAllRole(array('status' => 1), 'sort DESC');
         $info = $UserDB->getUser(array('user_id' => $id));
         $this->assign('tpltitle', '编辑');
         $this->assign('role', $role);
         $this->assign('info', $info);
         $this->display();
      }
   }

   //ajax 验证用户名
   public function check_username()
   {
      $userid = I('get.userid');
      $username = I('get.username');
      if (D("Admin")->check_name($username, $userid)) {
         echo 1;
      } else {
         echo 0;
      }
   }

   //删除用户
   public function del()
   {
      $id = I('get.id');
      if (!$id) $this->error('参数错误!');
      $UserDB = D('Admin');
      $info = $UserDB->getUser(array('user_id' => $id));
      if ($info['username'] == C('SPECIAL_USER')) {     //无视系统权限的那个用户不能删除
         $this->error('禁止删除此用户!');
      }
      if ($UserDB->delUser('user_id=' . $id)) {
         if (M("RoleUser")->where('user_id=' . $id)->delete()) {
            $this->assign("jumpUrl", U('/Admin/Role/index'));
            $this->success('删除成功！');
         } else {
            $this->error('用户成功,但角色对应关系删除失败!');
         }
      } else {
         $this->error('删除失败!');
      }
   }

   /* ========角色部分======== */

   // 角色管理列表
   public function role()
   {
      $RoleDB = D('Role');
      $list = $RoleDB->getAllRole();
      $this->assign('list', $list);
      $this->display();
   }

   // 添加角色
   public function role_add()
   {
      $RoleDB = M("Role");
      if (isset($_POST['dosubmit'])) {
         //根据表单提交的POST数据创建数据对象
         $data = I('post.');
         $data['status'] = 1;
         $data['pid'] = 0;

         if ($RoleDB->add($data)) {
            //$this->assign("jumpUrl",U('/Role/index'));
            $this->success('添加成功！', U('/Admin/Role/index'));
         } else {
            $this->error('添加失败!');
         }

      } else {
         //$this->assign('tpltitle','添加');
         $this->display();
      }
   }

   // 编辑角色
   public function role_edit()
   {
      $RoleDB = D("Role");
      if (isset($_POST['dosubmit'])) {
         //根据表单提交的POST数据创建数据对象
         $rdb = M('role');
         $data = I('post.');
         if ($rdb->where('id = "' . $data['id'] . '"')->save($data)) {
            //$this->assign("jumpUrl",U('/Role/index'));
            $this->success('编辑成功！', U('/Admin/Role/index'));
         } else {
            $this->error('编辑失败!');
         }
      } else {
         $id = I('get.id');
         if (!$id) $this->error('参数错误!');
         $info = $RoleDB->getRole(array('id' => $id));
         //$this->assign('tpltitle','编辑');
         $this->assign('info', $info);
         $this->display();
      }
   }

   //删除角色
   public function role_del()
   {
      $id = I('get.id');
      if (!$id) $this->error('参数错误!');
      $RoleDB = D('Role');
      if ($RoleDB->delRole('id=' . $id)) {
         //$this->assign("jumpUrl",U('/Role/index'));
         $this->success('删除成功！');
      } else {
         $this->error('删除失败!');
      }
   }

   // 排序权重更新
   public function role_sort()
   {
      $sorts = I('post.sort');
      if (!is_array($sorts)) $this->error('参数错误!');
      foreach ($sorts as $id => $sort) {
         D('Role')->upRole(array('id' => $id, 'sort' => intval($sort)));
      }
      $this->assign("jumpUrl", U('/Admin/Role/index'));
      $this->success('更新完成！');
   }

   /* ========权限设置部分======== */

   //权限浏览
   public function access()
   {

      $roleid = I('get.roleid');
      if (!$roleid) $this->error('参数错误!');
      Vendor('Common.Tree');  //导入通用树型类

      $Tree = new \Tree();
      $Tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
      $Tree->nbsp = '&nbsp;&nbsp;&nbsp;';

      $NodeDB = D('Node');
      $node = $NodeDB->getAllNode();

      $AccessDB = D('Access');
      $access = $AccessDB->getAllAccess('', 'role_id,node_id,pid,level');


      foreach ($node as $n => $t) {
         $node[$n]['checked'] = ($AccessDB->is_checked($t, $roleid, $access)) ? ' checked' : '';
         $node[$n]['depth'] = $AccessDB->get_level($t['id'], $node);
         $node[$n]['pid_node'] = ($t['pid']) ? ' class="tr lt child-of-node-' . $t['pid'] . '"' : '';
      }
      $str = "<tr id='node-\$id' \$pid_node>
                    <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='nodeid[]' value='\$id' class='radio' level='\$depth' \$checked onclick='javascript:checknode(this);' > \$title (\$name)</td>
                </tr>";

      $Tree->init($node);
      $html_tree = $Tree->get_tree(0, $str);
      $this->assign('html_tree', $html_tree);

      $this->display();
   }

   //权限编辑
   public function access_edit()
   {
      $roleid = I('post.roleid');
      $nodeid = I('post.nodeid');
      if (!$roleid) $this->error('参数错误!');
      $AccessDB = D('Access');

      if (is_array($nodeid) && count($nodeid) > 0) {  //提交得有数据，则修改原权限配置
         $AccessDB->delAccess(array('role_id' => $roleid));  //先删除原用户组的权限配置

         $NodeDB = D('Node');
         $node = $NodeDB->getAllNode();

         foreach ($node as $_v) $node[$_v[id]] = $_v;
         foreach ($nodeid as $k => $node_id) {
            $data[$k] = $AccessDB->get_nodeinfo($node_id, $node);
            $data[$k]['role_id'] = $roleid;
         }
         $AccessDB->addAll($data);   // 重新创建角色的权限配置
      } else {    //提交的数据为空，则删除权限配置
         $AccessDB->delAccess(array('role_id' => $roleid));
      }
      $this->assign("jumpUrl", U('/Admin/Role/access', array('roleid' => $roleid)));
      $this->success('设置成功！');
   }


}
