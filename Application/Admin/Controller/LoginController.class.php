<?php
/*
* Home分组公共类
*/

namespace Admin\Controller;

use Think\Verify;


class LoginController extends CommonController
{

    public function index()
    {
        $this->display();
    }
	/*
	* 空操作
	* 前台模块操作指定错误时调用
	*/
    public function _empty()
    {
    	$this->display(C('ERROR_PAGE'));
    	exit;
    }

    //加载验证码
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

    //登陆验证
     public function checklogin()
     {
        $data = I('post.');

         if($data['username'] =='' || $data['password']== ''){
             $this->error('用户名或者密码不能为空');
             exit;
         }


        $verify = new Verify();


        if (!$verify->check($data['verify'])) $this->error('验证码错误');

        $user = D('User');



        if($user->checklogin($data['username'], md5($data['password']))){

           $this->redirect('/Admin/Index/index');

        }else{
           $this->error($user->getError());
        }



//        $username = $this->_post('username');
//        $password =  $this->_post('password');
//        $verify   = $this->_post('verify');
//        //生成认证条件
//        $map            =   array();
//        // 支持使用绑定帐号登录
//        $map['username'] = $username;
//        $map['status']        = 1;
//        if(session('verify') != md5($verify)) {
//            $this->error('验证码错误！');
//        }
//        import('ORG.Util.RBAC');
//        $authInfo = RBAC::authenticate($map);
//        //使用用户名、密码和状态的方式进行认证
//        if(false == $authInfo) {
//            $this->error('帐号不存在或已禁用！');
//        }else {
//            if($authInfo['password'] != md5($password) ) {
//                $this->error('密码错误！');
//            }
//            session(C('USER_AUTH_KEY'), $authInfo['uid']);
//            session('userid',$authInfo['uid']);  //用户ID
//            session('username',$authInfo['username']);   //用户名
//            session('roleid',$authInfo['role_id']);    //角色ID
//            if($authInfo['username']==C('SPECIAL_USER')) {
//                session(C('ADMIN_AUTH_KEY'), true);
//            }
//           echo '你好';
//            //保存登录信息
//            $User   =   M(C('USER_AUTH_MODEL'));
//            $ip     =   get_client_ip();
//            $data = array();
//            if($ip){    //如果获取到客户端IP，则获取其物理位置
//                import('ORG.Net.IpLocation');// 导入IpLocation类
//                $Ip = new IpLocation(); // 实例化类
//                //$ip = '103.246.246.3';
//                $location = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
//                $data['last_location'] = '';
//                if($location['country'] && $location['country']!='CZ88.NET') $data['last_location'].=$location['country'];
//                if($location['area'] && $location['area']!='CZ88.NET') $data['last_location'].=' '.$location['area'];
//
//            }
//
//            $data['uid'] =   $authInfo['uid'];
//            $data['last_login']    =   time();
//            $data['last_login_ip']  =   get_client_ip();
//            $User->save($data);
          
               // 缓存访问权限
               //$list =  RBAC::saveAccessList();
               // var_dump($list);
               //       die();



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