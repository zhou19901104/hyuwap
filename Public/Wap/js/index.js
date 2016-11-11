/**
 * Created by chenjian on 16-10-20.
 */

window.onload = function(){
    /*导航栏*/
    //header();

    /*底栏高度调整*/
    reguHeight();

    /*医院仪器环境切换*/
    //instruShow();

    /*真人秀轮播*/
   // peopleShow();

    //活动定位

    activeShow();

};

    function activeShow()
    {
        var height = $('.main .main-content .active-list .active-left').height();
        $('.main .main-content .active-list .active-right').css('height', height);
    }


/*头部顶栏透明效果*/
var header = function(){
    /*搜索栏对象*/
    var search = document.getElementsByClassName('header')[0];
    /*banner对象*/
    var banner = document.getElementsByClassName('banner-img')[0];
    /*高度*/
    var height = banner.offsetHeight;
    window.onscroll = function () {
        var top = document.body.scrollTop;
        /*当滚动高度大于banner的高度时 颜色不变*/
        if(top > height){
            search.style.background = "rgba(0,0,0,1)";
        }else {
            var op = top/height * 0.85;
            search.style.background = "rgba(0,0,0,"+ op +")";
        }
    }
};

/*底栏高度调整*/
function reguHeight()
{
    var footHeight = $('.footer-list').height();
    $('.content-code').css('marginBottom', footHeight);
}

/*仪器设备*/
function instruShow(){
    /*医院环境仪器切换*/
    var titleHeight = $('.content-show > .content-title').outerHeight();
    var showHeight = $('.show-ul > li:first-child').height();
    var show_mt = $('.show-mt > span');
    var show_ul = $('.show-ul > li');

    $('.content-show').css('height', titleHeight + showHeight);

    for(var i=0; i<show_mt.length; i++){
        show_mt[i].index = i;

        $(show_mt[i]).on('click', function(){

            for(var j=0; j<show_mt.length; j++){
                $(show_mt[j]).removeClass('current');
                $(show_ul[j]).removeClass('show');

                if(this.index != j){
                    $(show_ul[j]).fadeOut(500);
                }
            }
            $(this).addClass('current');
            //$(show_ul[this.index]).addClass('show');
            $(show_ul[this.index]).fadeIn(500);
        });
    }
}

/*真人秀*/
function peopleShow() {

    var num = $('.people-radius > ul > li');
    var i_num = 0;
    var timer = null;
    var titleHeight = $('.content-people > .content-title').outerHeight();
    var showHeight = $('.people-list >ul > li:first-child').height();
    $('.content-people').css('height', titleHeight + showHeight);

    $('.people-list > ul > li:gt(0)').hide(); //页面加载隐藏所有 >1 的li
    console.log(num.length);

    function peopleMove(){
        timer = setInterval(function(){
            move_people();
        }, 3000);
    }
    peopleMove();

    function move_people(){

        if(i_num == num-1){
            i_num = -1;
        }

        //大图切换
        $('.people-list > ul > li').eq(i_num+1).fadeIn('slow').siblings('li').fadeOut('slow');
        //小图切换
        $('.people-radius > ul > li').eq(i_num+1).addClass('active').siblings('li').removeClass('active');
        i_num++;
        if(i_num == num.length-1){
            i_num = -1;
        }
    }
}





























































