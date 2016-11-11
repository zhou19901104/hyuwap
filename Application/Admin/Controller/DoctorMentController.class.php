<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-10-31
 * Time: 下午12:02
 */

namespace Admin\Controller;



class DoctorMentController extends CommonController
{

    /**
     * 医生列表
     */
    public function ment_list()
    {

        $ment = D('DoctorMent');
        $count = $ment->count();
        $mentData = $ment->select();

        $this->assign('count', $count);
        $this->assign('mentData', $mentData);
        $this->display();
    }

    /**
     * 增加部门
     */
    public function ment_add()
    {
        if(IS_POST){

            $ment = D('DoctorMent');

            if($data = $ment->create()){
                if($ment->add()){
                    $this->success('添加成功',U('Admin/DoctorMent/ment_list'));
                }else{
                    $this->error('添加失败',U('Admin/DoctorMent/ment_add'));
                }
            }else{
               $this->error($ment->getError());
            }
        }else{
            $this->display();
        }

    }
    /**
     * 医生部门修改
     */
    public function ment_edit()
    {
        $ment = D('DoctorMent');

        if(IS_POST){
            if($data = $ment->create()){

                if($ment->save()){
                    $this->success('修改成功',U('Admin/DoctorMent/ment_list'));
                }else{
                    $this->error('修改失败',U('Admin/DoctorMent/ment_edit',array('id' => $data['id'])));
                }
            }else{
                $this->error($ment->getError());
            }
        }else{
            $id = I('get.id');
            $data = $ment->find($id);
            $this->assign('data', $data);
            $this->display();
        }
    }

    /**
     * 医生部门删除
     */
    public function ment_del()
    {
        $id = I('get.id');
        $ment = D('DoctorMent');

        if($ment->delete($id)){
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


}