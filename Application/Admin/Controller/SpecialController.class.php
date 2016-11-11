<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-11-7
 * Time: 下午2:18
 */

namespace Admin\Controller;

use Think\Upload;

class SpecialController extends CommonController
{

    /*
     * 专题列表
     */
    public function special_list()
    {

        $special = D('Special');
        $data = $special->field('id,name,img_url,active,sort')->select();
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 专题添加
     */
    public function special_add()
    {

        if(IS_POST){

            $special = D('Special');
            $spcon = D('Spcon');
            $data = I('post.');

                if($_FILES['img_url']['name'] != ''){
                    $config = array(
                        'colnum' => 'img_url',
                        'path' => 'special'
                    );
                    $this->up_image($data, $config);
                }
            $data['active'] = 1;

            if($newId=  $special->add($data)){
                $dataMsg = [
                    'content' => html_entity_decode($data['content']),
                    'sp_id' => $newId
                ];
              if($spcon->add($dataMsg)){
                  $this->success('专题添加成功', U('Admin/Special/special_list'));
              }
             exit();
            }

            $this->error('专题添加失败', U('Admin/Special/special_list'));

        }else{
            $cate = D('Cate');
            $cateData = getTree($cate->field('id,pid,cate_name')->select());
            $this->assign('cateData', $cateData);
            $this->display();
        }


    }

    /**
     * 专题修改
     */
    public function special_edit()
    {
        if(IS_POST){

            $special = D('Special');
            $spcon = D('Spcon');
            $data = I('post.');
            $info = $special->field('img_url,id')->where('id='.$data['id'])->find();

            if($_FILES['img_url']['name'] != ''){
                $config = array(
                    'colnum' => 'img_url',
                    'path' => 'special'
                );
                $this->up_image($data, $config);
                @unlink($info['img_url']);
            }

            $dataMsg = [
                'content' => html_entity_decode($data['content']),
                'sp_id' => $data['id']
            ];

            //dump($data);dump($dataMsg);die(); ||

            if($special->save($data) || $spcon->where('sp_id=' .$dataMsg['sp_id'])->save($dataMsg) ){

                $this->success('专题修改成功', U('Admin/Special/special_list'));

            }else{
                $this->error('专题修改失败', U('Admin/Special/special_list'));
            }

        }else{
            $cate = D('Cate');
            $id = I('get.id');
            $data = D('Special')
                ->alias('s')
                ->field('s.id,s.pid,s.name,s.sort,s.img_url,c.sp_id,c.content')
                ->join('__SPCON__ c on s.id=c.sp_id')
                ->where('s.id='.$id)
                ->find();
            $this->assign('data', $data);
            $cateData = getTree($cate->field('id,pid,cate_name')->select());
            $this->assign('cateData', $cateData);
            $this->display();
        }
    }

    /**
     * 专题上架
     */
    public function article_start()
    {
        $id = I('get.id');
        $content = D('Special');

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
     * 专题下架
     */

    public function article_stop()
    {
        $id = I('get.id');
        $content = D('Special');

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
     * 专题删除
     */

    public function special_del()
    {
        $id = I('get.id');
        $special = D('Special');

        if($special->where(array('id' => $id))->delete()){
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

            $data['img_url'] = $img_url;
        }

    }








}