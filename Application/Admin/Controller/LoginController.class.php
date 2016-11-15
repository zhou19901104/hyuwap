<?php
/*
* Home分组公共类
*/

namespace Admin\Controller;

use Think\Verify;
use Org\Util\Rbac;
use Org\Net\IpLocation;

class LoginController extends CommonController
{
    /**
     * 后台首页
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 加载验证码
     */
    public function verify ()
    {
       $cfg = array(
         'fontSize' => 10,              // 验证码字体大小(px)
         'useCurve' => false,            // 是否画混淆曲线
         'useNoise' => false,            // 是否添加杂点
         'imageH' => 40,               // 验证码图片高度
         'imageW' => 80,               // 验证码图片宽度
         'length' => 4,               // 验证码位数
         'fontttf' => '5.ttf'
       );
       $verify = new Verify($cfg);
       $verify->entry();
    }

    /**
     * 登陆验证
     */
     public function checklogin()
     {
        $data = I('post.');

         if($data['username'] == '' || $data['password'] == ''){
             $this->error('用户名或者密码不能为空');
             exit;
         }

        $verify = new Verify();
        if (!$verify->check($data['verify'])) $this->error('验证码错误');

        $user = D('User');

        if($user->checklogin($data['username'], md5($data['password']))){

            $map = [];
            $map['username'] = $data['username'];
            $map['status'] = 1;
            //账户登录信息
            $authInfo = Rbac::authenticate($map);

            if(false == $authInfo){
                $this->error('帐号不存在或已禁用！');
                exit();
            }else{

                //已经登录成功
                session(C('USER_AUTH_KEY'), $authInfo['uid']);  //用户认证 session 标记
                session('uid', $authInfo['uid']);               //用户ID
                session('username', $authInfo['username']);     //用户名
                session('roleid', $authInfo['role_id']);        //角色ID

                if($authInfo['username'] == C('SPECIAL_USER')) {
                    session(C('ADMIN_AUTH_KEY'), true);
                }

            }

            $userModel = M(C('USER_AUTH_MODEL'));

            //$ip = get_client_ip();

            $userData = [];

//            if($ip){    //如果获取到客户端IP，则获取其物理位置
//                $Ip = new IpLocation();
//
//                $location = $Ip->getlocation($ip); //获取这个IP的地址
//
//                $userData['last_location'] = '';
//
//                if($location['country'] && $location['country'] != 'CZ88.NET') $data['last_location'] .= $location['country'];
//                if($location['area'] && $location['area'] != 'CZ88.NET') $data['last_location'] .= ' '.$location['area'];
//
//            }
            $authInfo['last_num']++;

            $userData['uid'] = $authInfo['uid'];
            $userData['login_time'] = time();
            $userData['login_ip'] = get_client_ip();
            $userData['last_num'] = $authInfo['last_num'];

            $userModel->save($userData);

            // 缓存访问权限
            $list =  Rbac::saveAccessList();
            //var_dump($list);
            //die();
            $this->assign('list', $list);
            $this->redirect('/Admin/Index/index');
        }else{
            $this->error($user->getError());
            exit();
        }

    }

   /**
    * 处理用户退出登录
    */
   public function logout()
   {
      session(null);
      $this->redirect('Admin/Login/index');
      exit();
   }

}