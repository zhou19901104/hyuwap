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

    <title>文章分类管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20 text-c">
    <div class="text-c">
        <input type="text" name="" placeholder="栏目名称、id" style="width:250px" class="input-text">
        <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="article_category_add('添加分类','article_category_add')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="80">排序</th>
                <th>分类级别</th>
                <th>分类名称</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($cateData)): foreach($cateData as $key=>$val): ?><tr class="text-c">
                    <td><input type="checkbox" name="" value=""></td>
                    <td><?php echo ($val["id"]); ?></td>

                    <td><?php echo ($val["level"]); ?></td>
                    <td class="text-l"><?php echo ($val["level"]); ?>级栏目</td>
                    <td class="text-l" <?php if($val['level'] == 1): ?>style="color: red;" <?php elseif($val['level'] == 2): ?>style="color: blue;"<?php endif; ?> >|<?php echo (str_repeat('--',$val["level"])); echo ($val["cate_name"]); ?></td>
                    <td class="f-14"><a title="编辑" href="javascript:;" onclick="article_category_edit('栏目编辑','article_category_edit','<?php echo ($val["id"]); ?>','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="article_category_del(this,'<?php echo ($val["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr><?php endforeach; endif; ?>


      <!--      <tr class="text-c">
                <td><input type="checkbox" name="" value=""></td>
                <td>2</td>
                <td>2</td>
                <td class="text-l">&nbsp;&nbsp;├&nbsp;二级栏目</td>
                <td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('栏目编辑','system-category-add.html','2','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="article_category_del(this,'2')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
            <tr class="text-c">
                <td><input type="checkbox" name="" value=""></td>
                <td>3</td>
                <td>3</td>
                <td class="text-l">&nbsp;&nbsp;├&nbsp;二级栏目</td>
                <td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('栏目编辑','system-category-add.html','3','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="system-category_del(this,'3')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>-->

            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
//    $('.table-sort').dataTable({
//        "aaSorting": false,//默认第几个排序
//        "bStateSave": true,//状态保存
//        "aoColumnDefs": [
//            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//            {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
//        ]
//    });
    /*系统-栏目-添加*/
    function article_category_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*系统-栏目-编辑*/
    function article_category_edit(title,url,id,w,h){
        layer_show(title,url + '/id/' + id,w,h);
    }
    /*系统-栏目-删除*/
    function article_category_del(obj,id){

        layer.confirm('确认要删除此分类吗,并删除对应文章？',function(index){

            $.ajax({
                url : '/Admin/Category/article_category_del',
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