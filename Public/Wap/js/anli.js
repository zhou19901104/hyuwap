/**
 * Created by chenjian on 16-11-5.
 */

window.onload = function(){
    /*底栏高度调整*/
    reguHeight();
    showAnli();

    /*案例切换*/
    cutShow("anli1");
    cutShow("anli2");
    cutShow("anli3");
};

/*底栏高度调整*/
function reguHeight()
{
    var footHeight = $('.footer-list').height();
    $('.content-code').css('marginBottom', footHeight);
}

function showAnli(){

    var content_title = $('.main > .anli-list .content-title').outerHeight();
    var case_list = $('.main > .anli-list .case-list > ul > li:first-child').height();
    var case_show = $('.main > .anli-list .case-show > ul > li:first-child').outerHeight();

    var anli_list = $('.main > .anli-list');

    $('.main > .anli-list .content-list').css('height', content_title + case_list);
    $('.main > .anli-list .content-list > .case-list').css('height',case_list);

    anli_list.css('height', content_title + case_list + case_show + 2);

}

/*案例切换*/
function cutShow(divId){


    var show_mt = $('#'+ divId +' .case-show > ul > li');
    var show_ul = $('#'+ divId +' .case-list > ul > li');

    for(var i=0; i<show_mt.length; i++){
        show_mt[i].index = i;

        $(show_mt[i]).on('click', function(){

            for(var j=0; j<show_mt.length; j++){
                $(show_mt[j]).removeClass('active');

                $(show_ul[j]).removeClass('show');
                if(this.index != j){
                    $(show_ul[j]).fadeOut(500);
                }
            }
            $(this).addClass('active');
            //$(show_ul[this.index]).addClass('show');
            $(show_ul[this.index]).fadeIn(500);
        });
    }
}






















