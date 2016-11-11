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
    <link href="/Public/Admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />


    <title>修改文章</title>
</head>
<body>
<div class="pd-20">
    <form action="/Admin/Content/article_edit" method="post" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>文章标题：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="<?php echo ($articleData["title"]); ?>" placeholder="" name="title">
                <input type="hidden" name="id" value="<?php echo ($articleData["id"]); ?>">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>分类栏目：</label>
            <div class="formControls col-2"> <span class="select-box">
				<select name="" class="select">
                    <option value="0">全部栏目</option>
                    <?php if(is_array($cate)): foreach($cate as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($articleData["cid"] == $val['id']): ?>selected="selected"<?php endif; ?> ><?php echo (str_repeat('--',$val["level"])); echo ($val["cate_name"]); ?></option><?php endforeach; endif; ?>

                </select>
				</span>
            </div>

            <label class="form-label col-2">排序值：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="<?php echo ($articleData["sort"]); ?>"  name="sort">
            </div>
        </div>

  <!--      <div class="row cl">
            <label class="form-label col-2">文章摘要：</label>
            <div class="formControls col-10">
                <textarea name="description" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($articleData["description"]); ?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>-->
        <div class="row cl">
            <label class="form-label col-2">关键词：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="<?php echo ($articleData["keyword"]); ?>" name="keyword">
            </div>
        </div>

   <!--     <div class="row cl">
            <label class="form-label col-2">缩略图：</label>
            <div class="formControls col-10">
                <div class="uploader-thum-container">
                    <input type="file" name="img_url" value="<?php echo ($articleData["img_url"]); ?>" id="exampleInputImg">
                    <?php if(!empty($articleData["img_url"])): ?><div class="form-group" id="div_user_logo">
                            <img src="<?php echo C('SITE_URL'); echo (substr($articleData["img_url"],1)); ?>" class="img-rect" id="img_user_logo" style="width: 380px;height: 284px;">
                        </div><?php endif; ?>
                </div>
            </div>
        </div>-->

        <div class="row cl">
            <label class="form-label col-2">文章内容：</label>
            <div class="formControls col-10">
                <textarea id="editor" name="content" style="width:100%;height:400px;"><?php echo ($articleData["content"]); ?></textarea>
            </div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 修改并提交审核</button>
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
<script type="text/javascript" src="/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/webuploader/0.1.5/webuploader.min.js"></script>

<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Public/Admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $(function(){
        var ue = UE.getEditor('editor');
    });
</script>
</body>
</html>