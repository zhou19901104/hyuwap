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

    <title>新增医生</title>
</head>
<body>
<div class="pd-20">
    <form action="/Admin/Doctor/doctor_edit" method="post" class="form form-horizontal" id="form-doctor-add">
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>医生姓名：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" name="name" value="<?php echo ($info["name"]); ?>">
                <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>医生部门：</label>
            <div class="formControls col-2"> <span class="select-box">
				<select name="ment_id" class="select">
                    <option value="">请选择医生部门</option>
                    <?php if(is_array($ment_list)): foreach($ment_list as $key=>$val): ?><option value="<?php echo ($val["mid"]); ?>"  <?php if($val['mid'] == $info['ment_id']): ?>selected<?php endif; ?> ><?php echo ($val["class_name"]); ?></option><?php endforeach; endif; ?>
                </select>
				</span>
            </div>

            <label class="form-label col-2">排序值：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="<?php echo ($info["sort"]); ?>" name="sort">
            </div>

        </div>
        <div class="row cl">
            <label class="form-label col-2">医生职称：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="<?php echo ($info["tech"]); ?>" name="tech">
            </div>
        </div>
<!--        <div class="row cl">
            <label class="form-label col-2">擅长项目：</label>
            <div class="formControls col-10">
                <textarea name="item" class="textarea"  placeholder="项目输入以' - '隔开" datatype="*10-100" dragonfly="true" nullmsg="项目不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($info["item"]); ?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>-->

        <!--   <div class="row cl">
         <label class="form-label col-2">文章作者：</label>
                   <div class="formControls col-2">
                       <input type="text" class="input-text" value="0" placeholder="" id="" name="">
                   </div>
                   <label class="form-label col-2">文章来源：</label>
                   <div class="formControls col-2">
                       <input type="text" class="input-text" value="0" placeholder="" id="" name="">
                   </div>
               </div>
               <div class="row cl">
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
               </div>
        <div class="row cl">
            <label class="form-label col-2">缩略图：</label>
            <div class="formControls col-10">
                <div class="uploader-thum-container">
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                    <button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
                </div>
            </div>
        </div>-->
        <div class="row cl">
            <label class="form-label col-2">医生文章：</label>
            <div class="formControls col-10">
                <textarea id="editor" name="message" style="width:100%;height:400px;"><?php echo ($info["message"]); ?></textarea>
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
        var form = document.getElementById('form-doctor-add');
        form.submit();
    }

    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $list = $("#fileList"),
                $btn = $("#btn-star"),
                state = "pending",
                uploader;

        var uploader = WebUploader.create({
            auto: true,
            swf: 'lib/webuploader/0.1.5/Uploader.swf',

            // 文件接收服务端。
            server: 'http://lib.h-ui.net/webuploader/0.1.5/server/fileupload.php',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on( 'fileQueued', function( file ) {
            var $li = $(
                            '<div id="' + file.id + '" class="item">' +
                            '<div class="pic-box"><img></div>'+
                            '<div class="info">' + file.name + '</div>' +
                            '<p class="state">等待上传...</p>'+
                            '</div>'
                    ),
                    $img = $li.find('img');
            $list.append( $li );

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
        });
        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress-box .sr-only');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
            }
            $li.find(".state").text("上传中");
            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file ) {
            $( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress-box').fadeOut();
        });
        uploader.on('all', function (type) {
            if (type === 'startUpload') {
                state = 'uploading';
            } else if (type === 'stopUpload') {
                state = 'paused';
            } else if (type === 'uploadFinished') {
                state = 'done';
            }

            if (state === 'uploading') {
                $btn.text('暂停上传');
            } else {
                $btn.text('开始上传');
            }
        });

        $btn.on('click', function () {
            if (state === 'uploading') {
                uploader.stop();
            } else {
                uploader.upload();
            }
        });



        var ue = UE.getEditor('editor');

    });


</script>
</body>
</html>