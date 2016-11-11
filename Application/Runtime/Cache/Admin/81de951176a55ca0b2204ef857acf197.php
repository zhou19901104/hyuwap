<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/Admin/lib/html5.js"></script>
    <script type="text/javascript" src="/Public/Admin/lib/respond.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>修改新闻</title>
</head>
<body>
<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="news-article-add" enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>新闻标题：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="<?php echo ($info["title"]); ?>" name="title">
                <input type="hidden" name="nid" value="<?php echo ($info["nid"]); ?>">
            </div>
        </div>
        <!--        <div class="row cl">
                    <label class="form-label col-2">简略标题：</label>
                    <div class="formControls col-10">
                        <input type="text" class="input-text" value="" placeholder="" name="">
                    </div>
                </div>-->
        <!--        <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>分类栏目：</label>
                    <div class="formControls col-2"> <span class="select-box">
                        <select name="" class="select">
                            <option value="0">全部栏目</option>
                            <option value="1">新闻资讯</option>
                            <option value="11">├行业动态</option>
                            <option value="12">├行业资讯</option>
                            <option value="13">├行业新闻</option>
                        </select>
                        </span> </div>
                    <label class="form-label col-2"><span class="c-red">*</span>文章类型：</label>
                    <div class="formControls col-2"> <span class="select-box">
                        <select name="" class="select">
                            <option value="0">全部类型</option>
                            <option value="1">帮助说明</option>
                            <option value="2">新闻资讯</option>
                        </select>
                        </span> </div>/div>-->
                 <div class="row cl">
                    <label class="form-label col-2">排序值：</label>
                    <div class="formControls col-2">
                        <input type="text" class="input-text" value="<?php echo ($info["sort"]); ?>" placeholder="" name="sort">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2">关键词：</label>
                    <div class="formControls col-10">
                        <input type="text" class="input-text" value="<?php echo ($info["keyword"]); ?>" placeholder="" name="keyword">
                    </div>
                </div>
        <div class="row cl">
            <label class="form-label col-2">文章摘要：</label>
            <div class="formControls col-10">
                <textarea name="description" class="textarea" datatype="*10-100" dragonfly="true" nullmsg="摘要不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($info["description"]); ?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>

        <!--        <div class="row cl">
                    <label class="form-label col-2">文章作者：</label>
                    <div class="formControls col-2">
                        <input type="text" class="input-text" value="0" placeholder="" name="">
                    </div>
                    <label class="form-label col-2">文章来源：</label>
                    <div class="formControls col-2">
                        <input type="text" class="input-text" value="0" placeholder="" name="">
                    </div>
                </div>-->
<!--        <div class="row cl">
            <label class="form-label col-2">缩略图：</label>
            <div class="formControls col-10">
                <div class="uploader-thum-container">
                    <input type="file" name="sm_img_url" value="浏览..." id="exampleInputImg">
                    <?php if(!empty($info["sm_img_url"])): ?><div class="form-group" id="div_user_logo">
                            <img src="<?php echo (substr($info["sm_img_url"],1)); ?>" class="img-rect" id="img_user_logo" style="width: 380px;height: 284px;">
                        </div><?php endif; ?>
                </div>
            </div>
        </div>-->
        <div class="row cl">
            <label class="form-label col-2">文章内容：</label>
            <div class="formControls col-10">
                <textarea id="editor" style="width:100%;height:400px;" name="content"><?php echo ($info["content"]); ?></textarea>
            </div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/Public/Admin/js/uploadPreview.js"></script>

<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">

    function article_save_submit(){
        var form = document.getElementById('news-article-add');
        form.submit();
    }

    $(function(){

        //new uploadPreview({ UpBtn: "exampleInputImg", DivShow: "div_user_logo", ImgShow: "img_user_logo" });
        var ue = UE.getEditor('editor');

    });

</script>
</body>
</html>