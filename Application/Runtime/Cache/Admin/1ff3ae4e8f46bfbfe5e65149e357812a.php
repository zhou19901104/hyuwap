<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link href="/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />

    <!--  <link href="/Public/Admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />-->

    <title>新增专题</title>
</head>
<body>
<div class="pd-20">
    <form action="/Admin/Special/special_edit" method="post" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">

        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>专题标题：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" placeholder="" value="<?php echo ($data["name"]); ?>" name="name">
                <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>专题栏目：</label>
            <div class="formControls col-2"> <span class="select-box">
				<select name="pid" class="select">
                    <option value="">请选择专题类别</option>
                    <?php if(is_array($cateData)): foreach($cateData as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($val["id"] == $data['pid']): ?>selected<?php endif; ?> >|<?php echo (str_repeat('--',$val["level"])); echo ($val["cate_name"]); ?></option><?php endforeach; endif; ?>
                </select>
				</span>
            </div>

            <!--           <label class="form-label col-2"><span class="c-red">*</span>文章类型：</label>
                       <div class="formControls col-2"> <span class="select-box">
                           <select name="" class="select">
                               <option value="0">全部类型</option>
                               <option value="1">帮助说明</option>
                               <option value="2">新闻资讯</option>
                           </select>
                           </span>
                       </div>-->

            <label class="form-label col-2">排序值：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="<?php echo ($data["sort"]); ?>" placeholder="" name="sort">
            </div>
        </div>
        <!--        <div class="row cl">
                    <label class="form-label col-2">关键词：</label>
                    <div class="formControls col-10">
                        <input type="text" class="input-text" value="0" placeholder="" id="" name="">
                    </div>
                </div>-->


        <!--       <div class="row cl">
                   <label class="form-label col-2">允许评论：</label>
                   <div class="formControls col-2 skin-minimal">
                       <div class="check-box">
                           <input type="checkbox" id="checkbox-pinglun">
                           <label for="checkbox-pinglun">&nbsp;</label>
                       </div>
                   </div>
               </div>
               <div class="row cl">
                   <label class="form-label col-2">使用独立模版：</label>
                   <div class="formControls col-10 skin-minimal">
                       <div class="check-box">
                           <input type="checkbox" id="checkbox-moban">
                           <label for="checkbox-moban">&nbsp;</label>
                       </div>
                       <button onClick="mobanxuanze()" class="btn btn-default radius ml-10">选择模版</button>
                   </div>
               </div>-->

        <div class="row cl">
            <label class="form-label col-2">缩略图：</label>
            <div class="formControls col-10">
                <div class="uploader-thum-container">
                    <input type="file" name="img_url" value="浏览..." id="exampleInputImg">

                    <?php if(!empty($data["img_url"])): ?><div class="form-group" id="div_user_logo">
                            <img src="<?php echo C('SITE_URL'); echo (substr($data["img_url"],1)); ?>" class="img-rect" id="img_user_logo" style="width: 380px;height: 284px;">
                        </div><?php endif; ?>

                </div>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2">文章内容：</label>
            <div class="formControls col-10">
                <!--<script id="editor" type="text/plain" style="width:100%;height:400px;"></script>-->
                <textarea id="editor" style="width:100%;height:400px;" name="content"><?php echo ($data["content"]); ?></textarea>
            </div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
                <button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="/Public/Admin/js/uploadPreview.js"></script>

<script type="text/javascript" src="/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script>
<!--<script type="text/javascript" src="/Public/Admin/lib/webuploader/0.1.5/webuploader.min.js"></script>-->
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    /**
     * 表单提交
     */
    function article_save_submit()
    {
        var form = document.getElementById('form-article-add');
        form.submit();
    }
    /**
     * 文章保存
     */
    function article_save()
    {
        var form = document.getElementById('form-article-add');
        form.save();
    }

    $(function(){
        //选中图片立即显示
        new uploadPreview({ UpBtn: "exampleInputImg", DivShow: "div_user_logo", ImgShow: "img_user_logo" });

        var ue = UE.getEditor('editor');

    });


</script>
</body>
</html>