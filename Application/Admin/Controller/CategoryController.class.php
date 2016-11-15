<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-10-11
 * Time: 下午4:38
 */

namespace Admin\Controller;

use Think\Upload;

class CategoryController extends CommonController
{

    /**
     * 文章分类列表
     */
    public function article_category()
    {

        $cate = D('Category');

        $count = $cate->count();

        $cateData = getTree($cate->field('id,pid,cate_name,abbob,sort')->order('sort ASC')->select());

        $this->assign('cateData', $cateData);
        $this->assign('count', $count);

        $this->display();
    }

    /**
     * 文章分类添加
     */
    public function article_category_add()
    {
        $cate = D('Category');
        if(IS_POST){
            if($data = $cate->create()){

             if($_FILES['img_url']['name'] != ''){
                    $config = array(
                        'colnum' => 'img_url',
                        'path' => 'category'
                    );
                    $this->up_image($data, $config);
                }

                if($cate->add($data)){
                    $this->success('添加成功！', U('Admin/Category/article_category'));
                }else{
                    $this->error('添加失败！', U('Admin/Category/article_category_add'));
                }

            }else{
                $this->error($cate->getError());
            }
        }else{

            $cateData = getTree($cate->field('id,pid,cate_name,abbob')->select());
            $this->assign('cateData', $cateData);
            $this->display();
        }

    }
    /**
     * 文章分类修改
     */
    public function article_category_edit()
    {
        $cate = D('Category');
        if(IS_POST){

            $data = I('post.');

            $info = $cate->field('id,img_url')->where(array('id' => $data['id']))->find();

                 if($_FILES['img_url']['name'] != ''){
                    $config = array(
                        'colnum' => 'img_url',
                        'path' => 'category'
                    );
                    $this->up_image($data, $config);
                     @unlink($info['img_url']);
                }

                if($cate->save($data)){
                    $this->success('修改成功！', U('Admin/Category/article_category'));
                }else{
                    $this->error('修改失败！', U('Admin/Category/article_category_edit'));
                }


        }else{

            $id = I('get.id');
            $data = $cate->field('id,pid,cate_name,abbob,sort,level,img_url')->find($id);
            $cateData = getTree($cate->field('id,pid,cate_name,abbob')->select());

            $this->assign('cateData', $cateData);
            $this->assign('data', $data);
            //dump($cateData);die();
            $this->display();
        }

    }

    /**
     * 分类删除
     */
    public function article_category_del()
    {
        $id = I('get.id');
        $cate = D('Category');

        if(!$info = $cate->field('id,pid,img_url')->where('pid='.$id)->find()){

            @unlink($info['img_url']); //删除对应图片

            if($cate->where(array('id' => $id))->delete()){
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

        }else{

            $data = [
                'message' => '有下级分类,删除失败',
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

}