<?php
/**
 *name:医生管理模块
 *date:2013-09-12
 *
 */

namespace Admin\Controller;

use Think\Upload;
use Think\Image;

class DoctorController extends CommonController
{

    /**
     * 医生列表
     */
    public function doctor_list()
    {
        $doctor = D('Doctor');
        $list = $doctor
            ->alias('d')
            ->field('d.id,d.name,d.ment_id,d.sort,d.related,m.img_url,m.did,b.mid,b.class_name')
            ->join('__DOCTOR_MSG__  m on m.did=d.id')
            ->join('__DOCTOR_MENT__ b on d.ment_id=b.mid')
            ->order('sort DESC')
            ->select();

        $count = $doctor->count();
        $this->assign('count', $count);
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 添加医生信息
     */
    public function doctor_add()
    {
        $doctor = D('Doctor');

        if (IS_POST) {

            $doctorMsg = D('DoctorMsg');

                $data = I('post.');
                if($data['ment_id'] == ''){
                    $this->error('请选择医生所属部门');
                }
                if($_FILES['img_url']['name'] != ''){
                    $config = array(
                        'width' => 340,
                        'height' => 180,
                        'colnum' => 'img_url',
                        'path' => 'doctor',
                    );
                    $this->th_image($data, $config);
                }
                $data['related'] = 1;
                if ( $newId = $doctor->add($data)) {
                    $dataMsg = [
                        'message' => html_entity_decode($data['message']),
                        'tech' => $data['tech'],
                        'img_url' => $data['img_url'],
                        'did' => $newId
                    ];
                    if($doctorMsg->add($dataMsg)){
                        $this->success('添加成功!');
                    }
                    exit();
                }

            $this->error('添加失败!');

        } else {
            $ment_list = D('DoctorMent')->select();
            $this->assign('ment_list', $ment_list);
            $this->display();
        }
    }

    /**
     * 修改医生信息
     */
    public function doctor_edit()
    {
        $doctor = D('Doctor');

        if (IS_POST) {
            $data = I('post.');
            $msg = D('DoctorMsg');
            $dataMsg = array(
                'tech' => $data['tech'],
                'message' => html_entity_decode($data['message']),
                'item' => $data['item'],
                'did' => $data['id']
            );

            if ($doctor->save($data) || $msg->where(array('did' => $dataMsg['did']))->save($dataMsg)) {
                $this->success('修改成功!', U('Admin/Doctor/doctor_list'));
            } else {
                $this->error('修改失败');
            }


        } else {

            $id = I('get.id');
            $info = $doctor
                    ->alias('d')
                    ->field('d.id,d.name,d.sort,d.ment_id,m.tech,m.did,m.message')
                    ->join('__DOCTOR_MSG__ as m on d.id=m.did')
                    ->where('d.id = "' . $id . '"')
                    ->find();

            $ment_list = D('DoctorMent')->field('mid,class_name')->select();
            $this->assign('ment_list', $ment_list);

            $this->assign('info', $info);
            $this->display();
        }
    }

    /**
     * 删除医生信息
     */
    public function doctor_del()
    {
        $doctor = D('Doctor');

        $id = I('get.id');

        if ($doctor->where(array('id' => $id))->delete()) {
            $data = [
                'message' => '删除成功',
                'member' => 1
            ];
            echo json_encode($data);

        } else {
            $data = [
                'message' => '删除失败',
                'member' => 2
            ];
            echo json_encode($data);
        }
    }

    /**
     *医生停用
     */
    public function doctor_stop()
    {
        $id = I('get.id');

        if(D('Doctor')->where(array('id'=>$id))->setField('related', 0)){

            $data = [
                'message' => '停用成功',
                'member' => 1
            ];
            echo json_encode($data);
        }else{
            $data = [
                'message' => '停用失败',
                'member' => 2
            ];
            echo json_encode($data);
        }

    }
    /**
     * 医生启用
     */
    public function doctor_start()
    {
        $id = I('get.id');

        if(D('Doctor')->where(array('id'=>$id))->setField('related', 1)){

            $data = [
                'message' => '启用成功',
                'member' => 1
            ];
            echo json_encode($data);
        }else{
            $data = [
                'message' => '启用失败',
                'member' => 2
            ];
            echo json_encode($data);
        }
    }

    /**
     * @param $data   接收的数据;
     * @param $width  缩略图的宽度;
     * @param $height 缩略图的高度;
     * @param $path  图片上传的子路径;
     */
    private function up_image(&$data, $config)
    {
        $width = isset($config['width']) ? $config['width'] : 200;
        $height = isset($config['height']) ? $config['height'] : 200;
        $type = isset($config['type']) ? $config['type'] : 6;
        $path = isset($config['path']) ? $config['path'] : 'comm';
        $colnum = isset($config['colnum']) ? $config['colnum'] : 'img_url';

        //判断上传的附件没有问题才进行处理
        if ($_FILES[$colnum]['error'] === 0) {
            $cfg = array(
                'rootPath' => './Public/Uploads/' . $path . '/'  //保存根路径
            );
            $upload = new Upload($cfg);

            $info = $upload->uploadOne($_FILES[$colnum]);
            //附件上传后的信息保存在数据库中
            if ($info) {
                $img_url = $upload->rootPath . $info['savepath'] . $info['savename'];
                $data[$colnum] = $img_url;
            }
            //给图片做缩略图
            // $img = new Image();
            // $img->open($img_url); //打开原图
            // $img->thumb($width, $height, $type);
            // //输出保存缩略图
            // $th_img_url = $upload->rootPath . $info['savepath'] . 'th_' . $info['savename'];
            // $img->save($th_img_url);
            // $data[$colnum] = $th_img_url;

        }

    }

    private function th_image(&$data, $config)
    {
//        $width = isset($config['width']) ? $config['width'] : 200;
//        $height = isset($config['height']) ? $config['height'] : 200;
//        $type = isset($config['type']) ? $config['type'] : 6;
        $path = isset($config['path']) ? $config['path'] : 'comm';
        $colnum = isset($config['colnum']) ? $config['colnum'] : 'img_url';

        //判断上传的附件没有问题才进行处理
        if ($_FILES[$colnum]['error'] === 0) {
            $cfg = array(
                'rootPath' => './Public/Uploads/' . $path . '/'  //保存根路径
            );
            $upload = new Upload($cfg);

            $info = $upload->uploadOne($_FILES[$colnum]);
            //附件上传后的信息保存在数据库中
            if ($info) {
                $img_url = $upload->rootPath . $info['savepath'] . $info['savename'];
                $data[$colnum] =  $img_url;
            }
//            //给图片做缩略图
//            $img = new Image();
//            $img->open($img_url); //打开原图
//            $img->thumb($width, $height, $type);
//            //输出保存缩略图
//            $th_img_url = $upload->rootPath . $info['savepath'] . 'th_' . $info['savename'];
//            $img->save($th_img_url);
//            $data['img_url'] = $th_img_url;

        }

    }

}
