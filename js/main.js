    
$(document).ready(function() {
/***********Кнопка возврата вверх******/
 $("#back-top").hide();                
     $(function () {
                    $(window).scroll(function () {
                        if ($(this).scrollTop() > 300) {
                            $('#back-top').fadeIn();
                        } else {
                            $('#back-top').fadeOut();
                        }
                    });                    
                    $('#back-top a').click(function () {
                        $('body,html').animate({
                            scrollTop: 0
                        }, 800);
                        return false;
                    });
    });
    
    


 /***********Image hidden on phones******/
 $(".text-block img").addClass("hidden-xs");
 

 
});

