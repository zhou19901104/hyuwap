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
    <title>添加部门</title>
</head>
<body>
<div class="pd-20">
    <form action="/Admin/DoctorMent/ment_add" method="post" class="form form-horizontal" id="form-category-add">
        <div id="tab-category" class="HuiTab">
            <div class="tabBar cl"><span>基本设置</span></div>
            <div class="tabCon">
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>部门名称：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" name="class_name" datatype="*2-16" nullmsg="部门名称不能为空">
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
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">

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
    });
</script>
</body>
</html>