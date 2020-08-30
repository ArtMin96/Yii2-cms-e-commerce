$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.artmin-scrollup').fadeIn();
        } else {
            $('.artmin-scrollup').fadeOut();
        }
    });
    $('.artmin-scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});