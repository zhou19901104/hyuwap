<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <LINK rel="Bookmark" href="/favicon.ico" >
    <LINK rel="Shortcut Icon" href="/favicon.ico" />

    <link href="/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />


    <title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 医生管理 <span class="c-gray en">&gt;</span> 医生列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="text-c">
        <input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
        <button type="submit" class="btn btn-success" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="doctor_add('添加医生','doctor_add')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加医生</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="9">员工列表</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="40">ID</th>
            <th width="150">医生名</th>
            <th width="90">排序</th>
            <th width="90">部门</th>
            <th width="150">照片</th>
            <th width="100">是否在院</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>

        <?php if(is_array($list)): foreach($list as $key=>$val): ?><tr class="text-c">
            <td><input type="checkbox" value="1" name=""></td>
            <td><?php echo ($val["id"]); ?></td>
            <td><?php echo ($val["name"]); ?></td>
            <td><?php echo ($val["sort"]); ?></td>
            <td><?php echo ($val["class_name"]); ?></td>
            <td><img src="<?php echo (substr($val["img_url"],1)); ?>" alt="<?php echo ($val["name"]); ?>"></td>
            <?php if($val["related"] == 1): ?><td class="td-status"><span class="label label-success radius">在院</span></td>
                <td class="td-manage"><a style="text-decoration:none" onClick="doctor_stop(this,'<?php echo ($val["id"]); ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="doctor_edit('医生编辑','doctor_edit','<?php echo ($val["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="doctor_del(this,'<?php echo ($val["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            <?php else: ?>
                <td class="td-status"><span class="label label-error radius">不在院</span></td>
                <td class="td-manage"><a style="text-decoration:none" onClick="doctor_start(this,'<?php echo ($val["id"]); ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="doctor_edit('医生编辑','doctor_edit','<?php echo ($val["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="doctor_del(this,'<?php echo ($val["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td><?php endif; ?>
        </tr><?php endforeach; endif; ?>

        </tbody>
    </table>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    /*
     参数解释：
     title	标题
     url		请求的url
     id		需要操作的数据id
     w		弹出层宽度（缺省调默认值）
     h		弹出层高度（缺省调默认值）
     */

    /*医生-增加*/
    function doctor_add(title,url,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*医生-删除*/
    function doctor_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                url : '/Admin/Doctor/doctor_del',
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
    /*医生-编辑*/
    function doctor_edit(title,url,id,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url + '/id/' + id
        });
        layer.full(index);
    }

    /*医生-停用*/
    function doctor_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                url : '/Admin/Doctor/doctor_stop',
                data : {'id' : id},
                type : 'get',
                dataType : 'json',
                success : function (data) {
                    layer.msg(data.message,{icon: data.member,time:1000});
                }
            });
        });
    }

    /*管理员-启用*/
    function doctor_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                url : '/Admin/Doctor/doctor_start',
                data : {'id' : id},
                type : 'get',
                dataType : 'json',
                success : function (data) {
                    layer.msg(data.message,{icon: data.member,time:1000});
                }
            });
        });
    }
</script>
</body>
</html>