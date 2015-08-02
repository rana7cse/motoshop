
$(document).ready(function(){
    $('.collapsible').collapsible({
        accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    $('#user_menu').click(function(){
        $('.user_menu_drop').toggleClass('on');
    });
});
