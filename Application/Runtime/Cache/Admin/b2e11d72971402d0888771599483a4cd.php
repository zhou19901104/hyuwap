<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link href="/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />

    <title>分类设置</title>
</head>
<body>
<div class="pd-20">
    <form action="/Admin/Category/article_category_add" method="post" class="form form-horizontal" id="form-category-add" enctype="multipart/form-data">
        <div id="tab-category" class="HuiTab">
            <div class="tabBar cl"><span>基本设置</span><!--<span>模版设置</span><span>SEO</span>--></div>
            <div class="tabCon">
          <!--      <div class="row cl">
                    <label class="form-label col-3">栏目ID：</label>
                    <div class="formControls col-6">11230</div>
                </div>-->
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>上级栏目：</label>
                    <div class="formControls col-6"> <span class="select-box">
						<select class="select" id="sel_Sub" name="pid" onchange="SetSubID(this);">
                            <option value="0" level="0">顶级分类</option>
                            <?php if(is_array($cateData)): foreach($cateData as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" level="<?php echo ($val["level"]); ?>">|<?php echo (str_repeat('--',$val["level"])); echo ($val["cate_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
						</span> </div>
                    <div class="col-3"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>分类名称：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" name="cate_name" datatype="*2-16" nullmsg="分类名称不能为空">
                    </div>
                    <div class="col-3"> </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-2">缩略图：</label>
                        <div class="formControls col-10">
                        <div class="uploader-thum-container">
                        <input type="file" name="img_url" value="浏览..." id="exampleInputImg">
                            <div class="form-group" id="div_user_logo">
                            <img  class="img-rect" id="img_user_logo" style="width: 340px;height: 192px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-3">别名：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" placeholder="请输入英文" name="abbob">
                    </div>
                    <div class="col-3"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">排序：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" placeholder="请输入数字"  name="sort">
                    </div>
                    <div class="col-3"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">等级：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" value="1" id="cate-level" name="level">
                    </div>
                    <div class="col-3"> </div>
                </div>

            </div>

        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script>

<script type="text/javascript" src="/Public/Admin/js/uploadPreview.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">

    /**
     * 选择 select
     * @param obj Select对象
     * @constructor
     */
    function SetSubID(obj)
    {
        var level = document.getElementById('cate-level');
        level.value = parseInt(obj.options[obj.selectedIndex].getAttribute('level')) + 1;
    }

    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-article-category-add").Validform({
            tiptype:2,
            callback:function(form){
                form[0].submit();
                var index = parent.layer.getFrameIndex(window.name);
                parent.$('.btn-refresh').click();
                parent.layer.close(index);
            }
        });

        $.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");

        new uploadPreview({ UpBtn: "exampleInputImg", DivShow: "div_user_logo", ImgShow: "img_user_logo" });
    });
</script>
</body>
</html>