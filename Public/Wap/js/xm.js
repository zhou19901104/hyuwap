/**
 * Created by chenjian on 16-11-5.
 */


window.onload = function(){
    /*底栏高度调整*/
    reguHeight();

    bannerShow();
};

/*底栏高度调整*/
function reguHeight()
{
    var footHeight = $('.footer-list').height();
    $('.content-code').css('marginBottom', footHeight);
}

//banner轮播
function bannerShow()
{
    var num = $('.main-banner > .banner-img > ul > li');
    var i_num = 0;
    var timer = null;

    var bannerHeight = $('.main-banner > .banner-img  >ul > li:first-child').height();
    $('.main-banner').css('height', bannerHeight);
    $('.main-banner > .banner-img  > ul > li:gt(0)').hide(); //页面加载隐藏所有 >1 的li


    if(num.length > 1){
        function peopleMove(){
            timer = setInterval(function(){
                move_banner();
            }, 3000);
        }

        peopleMove();
        for(var i=0; i< num.length; i++){
            $('.main-banner > .banner-radius > ul ').append('<li></li>');
        }
        $('.main-banner > .banner-radius > ul li:first-child').addClass('show');
        $('.main-banner > .banner-radius ul li').css('marginLeft', 3);
        var banner_radius = $('.main-banner > .banner-radius').outerWidth();
        $('.main-banner > .banner-radius').css('marginLeft', -banner_radius/2);

        function move_banner(){

            if(i_num == num.length -1){
                i_num = -1;
            }

            //大图切换
            $('.main-banner > .banner-img > ul > li').eq(i_num + 1).fadeIn('slow').siblings('li').fadeOut('slow');
            //小图切换
            $('.main-banner > .banner-radius > ul > li').eq(i_num+1).addClass('show').siblings('li').removeClass('show'); i_num++;
            if(i_num == num.length -1){
                i_num = -1;
            }
        }
    }


}

