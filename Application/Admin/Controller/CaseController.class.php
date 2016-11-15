<?php
/**
 *name:案例管理模块
 *date:2013-09-12
 *
 */

namespace Admin\Controller;

use Think\Upload;

class CaseController extends CommonController
{

    /**
     * 案例列表
     */
    public function case_list()
    {

        $case = D('Case');
        $data = $case->field('id,name,img_url,active,sort')->select();
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 添加案例
     */
    public function case_add()
    {
        $case = D('Case');
        if (IS_POST) {

            $data = I('post.');
            //判断是否有图片上
            if ($_FILES['img_url']['name'] != '') {
                $config = array(
                    'colnum' => 'img_url',
                    'path' => 'case',
                );
                $this->up_image($data, $config);
            }

            //dump($data);die();
            if ($newId = $case->add($data)) {
                $casecon = D('Casecon');
                $dataMsg = [
                    'content' => html_entity_decode($data['content']),
                    'ca_id' => $newId
                ];
                if($casecon->add($dataMsg)){
                    $this->success('添加成功!', U('Admin/Case/case_list'));
                }
                exit();
            }

            $this->error('添加失败!', U('Admin/Case/case_list'));

        } else {

            $this->display();
        }

    }

    public function case_edit()
    {
        $case = D('Case');

        if (IS_POST) {

            $casecon = D('Casecon');
            $data = I('post.');

            $info = $case->field('id,img_url')->find($data['id']);

            if ($_FILES['img_url']['name'] != '') {
                $config = array(
                    'colnum' => 'img_url',
                    'path' => 'case',
                );
                $this->up_image($data, $config);
                @unlink($info['img_url']);
            }

            $dataMsg = [
                'content' => html_entity_decode($data['content']),
                'ca_id' => $data['id']
            ];

            if ($case->save($data) || $casecon->where(array('ca_id' => $data['id']))->save($dataMsg)) {

                $this->success('修改成功!', U('Admin/Case/case_list'));
            } else {
                $this->error('修改失败!');
            }

        } else {

            $id = I('get.id');
            $data = $case
                ->alias('s')
                ->field('s.id,s.name,s.sort,s.img_url,c.ca_id,c.content')
                ->join('__CASECON__ c on s.id=c.ca_id')
                ->where('s.id='.$id)
                ->find();
            $this->assign('data', $data);
            $this->display();

        }
    }


    /**
     * 案例上架
     */
    public function article_start()
    {
        $id = I('get.id');
        $content = D('Case');

        if($content->where(array('id'=> $id))->setField('active', 1)){
            $data = [
                'message' => '上架成功',
                'member' => 1
            ];
            echo json_encode($data);

        }else{
            $data = [
                'message' => '上架失败',
                'member' => 2
            ];
            echo json_encode($data);
        }
    }
    /**
     * 案例下架
     */

    public function article_stop()
    {
        $id = I('get.id');
        $content = D('Case');

        if($content->where(array('id'=> $id))->setField('active', 0)){
            $data = [
                'message' => '下架成功',
                'member' => 1
            ];
            echo json_encode($data);

        }else{
            $data = [
                'message' => '下架失败',
                'member' => 2
            ];
            echo json_encode($data);
        }
    }


    /**
     * 删除案例
     */
    public function case_del()
    {
        $id = I('get.id');
        $case = D('Case');
        $info = $case->field('id,img_url')->where(array('id' => $id))->find();

        if ($case->where(array('id' => $id))->delete()) {

            @unlink($info['img_url']);

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
     * @param $data   接收的数据;
     * @param $width  缩略图的宽度;
     * @param $height 缩略图的高度;
     * @param $path  图片上传的子路径;
     */
    private function up_image(&$data, $config)
    {
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
            }

            $data[$colnum] = $img_url;
        }

    }

    /**
     *实现案例相册图片的批量上传处理
     * @param [int] $goods_id 给该$goods_id的商品进行相册上传和缩略图制作处理
     */
    private function deal_pics(&$data, $config)
    {
        $path = isset($config['path']) ? $config['path'] : 'comm';
        $type = isset($config['type']) ? $config['type'] : 6;

            //实现批量相册上传
            $cfg = array(
                'rootPath' => './Public/Uploads/' . $path . '/', //保存根路径
            );
            $up = new Upload($cfg);
            $result = $up->upload($_FILES);
            //遍历$z,对各个上传好的"相册"进行对应的处理
            //dump($result);

            foreach ($result as $k => $v) {
                //原图路径名
                $img_url = $up->rootPath . $v['savepath'] . $v['savename'];

                $list_url = $up->rootPath . $v['savepath'] . $v['savename'];

                $min_url = $up->rootPath . $v['savepath'] . $v['savename'];

                $data['img_url'] = $img_url;
                $data['list_url'] = $list_url;
                $data['min_url'] = $min_url;

            }

    }


}