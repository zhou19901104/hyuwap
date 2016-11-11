<?php

namespace Admin\Controller;

use Think\Controller;


class CommonController extends Controller
{

   public function __construct()
   {
      parent::__construct();

      if(CONTROLLER_NAME != 'Login'){
         if(session('uid') != 1){
            $this->redirect('Wap/Web/index');
         }
      }

   }

}