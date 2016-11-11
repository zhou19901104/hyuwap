<?php
/**
 * Created by PhpStorm.
 * User: chenjian
 * Date: 16-10-11
 * Time: 下午4:38
 */

namespace Admin\Controller;


class CategoryController extends CommonController
{

    /**
     * 文章分类列表
     */
    public function article_category()
    {

        $cate = D('Category');

        $count = $cate->count();

        $cateData = getTree($cate->field('id,pid,cate_name,abbob')->select());

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

            if($data = $cate->create()){

                if($cate->save($data)){
                    $this->success('修改成功！', U('Admin/Category/article_category'));
                }else{
                    $this->error('修改失败！', U('Admin/Category/article_category_edit'));
                }

            }else{
                $this->error($cate->getError());
            }
        }else{

            $id = I('get.id');
            $data = $cate->field('id,pid,cate_name,abbob,sort,level')->find($id);
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

        if(!$cate->field('id,pid')->where('pid='.$id)->find()){

            if($cate->delete($id)){
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

}