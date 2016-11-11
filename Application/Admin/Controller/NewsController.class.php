<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-9-12
 * Time: 下午5:42
 */

namespace Admin\Controller;

use Think\Upload;


class NewsController extends CommonController
{

    /**
     * 新闻列表
     */
    public function news_list()
    {


        $new = D('News');
        $new_data = $new
                ->field('nid,title,createtime,description,related,keyword')
                ->select();

        $count = $new->count();
        $this->assign('count', $count);
        $this->assign('newData', $new_data);
        $this->display();
    }

    /**
     * 添加新闻
     */
    public function news_add()
    {

        if (IS_POST) {

            $new = D('News');
            $data = I('post.');

                $data['related'] = 1;
                $data['time'] = time();
                $data['content'] = html_entity_decode($data['content']);

                if ($newId = $new->add($data)) {
                    $this->success('文章添加成功', U('Admin/News/news_list'), 2);
                }else{
                    $this->error('文章添加失败', U('News/news_list'), 2);
                }

        } else {
            $this->display();
        }

    }

    /**
     * 新闻删除
     */
    public function news_del()
    {
        $id = I('get.id');
        $new = D('News');

        if ($new->delete($id)) {
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
     * 新闻动态修改
     */
    public function news_edit()
    {
        $new = D('News');

        if(IS_POST){

            $data = I('post.');

            $data['content'] = html_entity_decode($data['content']);
            $data['time'] = time();

                if($new->save($data)){

                    $this->success('文章修改成功', U('News/news_list'), 2);
                }else{
                    $this->error('文章修改失败', U('News/news_list'), 2);
                }

        }else{

            $id = I('get.id');
            //dump($id);die();
            $info = $new
                    ->field('nid,title,description,content,keyword,sort')
                    ->where('nid='.$id)
                    ->find();

            $this->assign('info', $info);
            $this->display();
        }

    }
    /**
     * 新闻审核
     */
    public function news_stop()
    {
        $id = I('get.id');
        $content = D('News');

        if($content->where(array('nid'=> $id))->setField('related', 0)){
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
     * 新闻下架
     */
    public function news_start()
    {
        $id = I('get.id');
        $content = D('News');

        if($content->where(array('nid'=> $id))->setField('related', 1)){
            $data = [
                'message' => '审核成功',
                'member' => 1
            ];
            echo json_encode($data);

        }else{
            $data = [
                'message' => '审核失败',
                'member' => 2
            ];
            echo json_encode($data);
        }
    }
    /**
     * @param $data   接收的数据
     * @param $width  缩略图的宽度
     * @param $height 缩略图的高度
     * @param $path  图片上传的子路径
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
                $bg_img_url = $upload->rootPath . $info['savepath'] . $info['savename'];
                $data[$colnum] = $bg_img_url;
            }
        }

    }

}