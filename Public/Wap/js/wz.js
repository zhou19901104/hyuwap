/**
 * Created by chenjian on 16-11-12.
 */

window.onload = function(){
    /*底栏高度调整*/
    reguHeight();

};

/*底栏高度调整*/
function reguHeight()
{
    var footHeight = $('.footer-list').height();
    $('.content-code').css('marginBottom', footHeight);
}
