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

    <title>节点管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 节点管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="text-c">
        <form class="Huiform" method="post" action="" target="_self">
            <input type="text" class="input-text" style="width:250px" placeholder="节点名称" name="">
            <button type="submit" class="btn btn-success" name=""><i class="Hui-iconfont">&#xe665;</i> 搜权限节点</button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加权限节点','admin_permission_add','','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加节点</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="7">权限节点</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="40">ID</th>
            <th width="200">节点名称</th>
            <th>节点名</th>
            <th>节点简介</th>
            <th>节点状态</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($nodeData)): foreach($nodeData as $key=>$val): ?><tr class="text-c">
            <td><input type="checkbox" value="1" name=""></td>
            <td><?php echo ($val["id"]); ?></td>
            <td <?php if($val["level"] == 1): ?>style="color:red;"<?php elseif($val["level"] == 2): ?>style="color:blue;"<?php endif; ?> ><?php echo ($val["name"]); ?></td>
            <td><?php echo ($val["title"]); ?></td>
            <td><?php echo ($val["remark"]); ?></td>
            <?php if($val["status"] == 1): ?><td class="td-status"><span class="label label-success radius">激活</span></td>
                <?php else: ?>
                <td class="td-status"><span class="label label-error radius">未激活</span></td><?php endif; ?>

            <td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('节点编辑','admin_permission_edit','<?php echo ($val["id"]); ?>','','700')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,'<?php echo ($val["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
    /*管理员-权限-添加*/
    function admin_permission_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*管理员-权限-编辑*/
    function admin_permission_edit(title,url,id,w,h){
        layer_show(title,url+ '/id/' + id,w,h);
    }

    /*管理员-权限-删除*/
    function admin_permission_del(obj,id){
        layer.confirm('节点删除须谨慎，确认要删除吗？',function(index){
            $.ajax({
               url:'/Admin/Node/admin_permission_del',
               data:{'id' : id},
               type : 'get',
               dataType: 'json',
               success : function (data) {
                   layer.msg(data,{icon:1,time:2000});
                   if(data == '删除成功'){
                       $(obj).parents("tr").remove();
                   }
               },
               error : function(data){
                   layer.msg(data,{icon:1,time:2000});
               }

            });

        });
    }
</script>
</body>
</html>