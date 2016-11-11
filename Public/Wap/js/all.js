/*
* @Author: cuixiaofei
* @Date:   2016-07-21 22:57:58
* @Last Modified by:   cuixiaofei
* @Last Modified time: 2016-07-23 00:10:11
*/
$(function() {

// 点击左上角按钮弹出列表	
$('.nav-wrap .navbtn').click(function(event) {
		//$('.indexmenu').stop().animate({'left': '0'}, 400);
		$('.indexmenu').stop().animate({
				left:'52%',
				opacity : '0.9'
		},400);
		$('.cover').css('display', 'block');	
});
$('.wrap .cover').click(function(event) {
		$('.indexmenu').stop().animate({'left': '100%'}, 400);
		$('.cover').css('display', 'none');	
			
});

/*首页轮播图*/


// 医生列表页点击左边导航栏右边更换
$('.project .pro-l .projectul li').click(function(event) {
	var liindex=$(this).index();
	$(this).addClass('current').siblings('li').removeClass('current');
	$('.doc-r').eq(liindex).show().siblings('.doc-r').hide();
	$('.pro-r').eq(liindex).show().siblings('.pro-r').hide();
});

$('.top').click(function(event) {
	$('html,body').animate({scrollTop:0}, 400)
});

});