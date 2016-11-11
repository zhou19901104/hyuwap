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
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />

    <title>部门管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 部门管理 <span class="c-gray en">&gt;</span> 医生部门 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="javascript:;" onclick="ment_add('添加部门','ment_add','800')"><i class="Hui-iconfont">&#xe600;</i> 添加部门</a> </span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="6">部门管理</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" value="" name=""></th>
            <th width="40">ID</th>
            <th width="200">部门名称</th>
            <th>排序</th>
            <th width="70">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($mentData)): foreach($mentData as $key=>$val): ?><tr class="text-c">
            <td><input type="checkbox" value="" name=""></td>
            <td><?php echo ($val["id"]); ?></td>
            <td><?php echo ($val["class_name"]); ?></td>
            <td><a href="#"><?php echo ($val["sort"]); ?></a></td>
            <td class="f-14"><a title="编辑" href="javascript:;" onclick="ment_edit('部门编辑','ment_edit','<?php echo ($val["mid"]); ?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="ment_del(this,'<?php echo ($val["mid"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
        </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    /*部门-添加*/
    function ment_add(title,url,w,h)
    {
        layer_show(title,url,w,h);
    }
    /*部门-编辑*/
    function ment_edit(title,url,id,w,h)
    {
        layer_show(title,url + '/id/' + id,w,h);
    }
    /*部门-删除*/
    function ment_del(obj,id)
    {

        layer.confirm('部门删除须谨慎，确认要删除吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                url : '/Admin/DoctorMent/ment_del',
                data : {'id' : id},
                type : 'get',
                dataType : 'json',
                success : function (data) {
                    layer.msg(data.message,{icon: data.member,time:1000});
                    if(data.member == 1){
                        $(obj).parents("tr").remove();
                    }
                }
            });
        });
    }
</script>
</body>
</html>