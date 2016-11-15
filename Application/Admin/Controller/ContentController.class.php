<?php
/**
 *name:文章管理模块
 *date:2013-09-12
 *
 */

namespace Admin\Controller;

use Think\Upload;

class ContentController extends CommonController
{

    /**
     * 文章列表
     */
    public function article_list()
    {
        $content = D('Content');

        $count = $content->count('id');

        $content_list = $content
            ->alias('d')
            ->field('d.id,d.cid,d.title,d.createtime,d.related,d.keyword')
            ->order('d.id ASC')
            ->select();
        $this->assign('content_list', $content_list);
        $this->assign('count', $count);
        $this->display();
    }

    /**
     * 文章添加
     */
    public function article_add()
    {

        $content = D('Content');

        if(IS_POST){

            if($data = $content->create()){

//                if($_FILES['img_url']['name'] != ''){
//                    $config = array(
//                        'width' => 380,
//                        'height' => 284,
//                        'colnum' => 'img_url',
//                        'path' => 'content'
//                    );
//
//                    $this->up_image($data, $config);
//                }

                $data['createtime'] = time();
                $data['related'] = 1;
                $data['content'] = html_entity_decode($data['content']);

                if($content->add($data)){
                    $this->success('添加成功！', U('Admin/Content/article_list'));
                }else{
                    $this->error('添加失败！', U('Admin/Content/article_list'));
                }
            }else{
               $this->error($content->getError());
            }

        }else{

            $cate = getTree(D('Category')->field('id,pid,cate_name')->select());
            $this->assign('cate', $cate);
            $this->display();
        }

    }
    /**
     * 文章修改
     */
    public function article_edit()
    {
        $content = D('Content');

        if(IS_POST){

            if($data = $content->create()){

                //$info = $content->field('img_url,id')->find($data['id']);
       /*         if($_FILES['img_url']['name'] != ''){
                    $config = array(
                        'width' => 380,
                        'height' => 284,
                        'colnum' => 'img_url',
                        'path' => 'content'
                    );
                    $this->up_image($data, $config);
                    @unlink($info['img_url']);
                }*/

                $data['createtime'] = time();
                $data['content'] = html_entity_decode($data['content']);

                if($content->save($data)){
                    $this->success('修改成功！', U('Admin/Content/article_list'));
                }else{
                    $this->error('修改失败！', U('Admin/Content/article_edit',array('id' => $data['id'])));
                }
            }else{
                $this->error($content->getError());
            }

        }else{

            $id = I('get.id');
            $cate = getTree(D('Category')->field('id,pid,cate_name')->select());

            $articleData = $content
                        ->field('id,cid,title,keyword,content')
                        ->find($id);
            $this->assign('articleData', $articleData);
            $this->assign('cate', $cate);
            $this->display();
        }
    }
    /**
     * 文章删除
     */
    public function article_del()
    {
        $id = I('get.id');
        $content = D('Content');

        if($content->where(array('id' => $id))->delete()){
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
     * 文章下架
     */
    public function article_stop()
    {
        $id = I('get.id');
        $content = D('Content');

        if($content->where(array('id'=> $id))->setField('related', 0)){
            $data = [
                'message' => '撤销成功',
                'member' => 1
            ];
            echo json_encode($data);

        }else{
            $data = [
                'message' => '撤销失败',
                'member' => 2
            ];
            echo json_encode($data);
        }
    }
    /**
     * 文章发布
     */
    public function article_start()
    {
        $id = I('get.id');
        $content = D('Content');

        if($content->where(array('id'=> $id))->setField('related', 1)){
            $data = [
                'message' => '发布成功',
                'member' => 1
            ];
            echo json_encode($data);

        }else{
            $data = [
                'message' => '发布失败',
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