// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$(function(){
    //fixed menu
    $(".header").before($(".header").clone().addClass("animateIt"));
    $(window).on("scroll", function () {
        $("body").toggleClass("down", ($(window).scrollTop() > 63));
        $(".header").eq(1).find('.expanded').removeClass('expanded');
    });

    //search form responsive (641 to 1023)
    $('#search-box button').click(function(){
        w = $( window ).width();
        if (w > 640 && w < 1024){
            $(this).parent().toggleClass('show');
        }
    });
    $( window ).resize(function() {
        //reset display search box
        $('#search-box').removeClass('show');
    });


    //dropdown choose the product
    $('#drop-view').click(function(){
        $( '#'+ $(this).data('target')).slideToggle();
    });

  	//gallery large view
    if($('.fancybox').length > 0) {
        $('.fancybox').fancybox({
            padding: 0,
			margin: 0,
			tpl : {
				closeBtn : '<a title="Close" class="fancybox-item fancybox-close close" href="javascript:;">Close <i class="ti-close"></i></a>'
			},
			helpers : {
				title : { type : 'inside' }
			},
			beforeShow: function(){
				var caption = $(this.element).siblings('div');
				if(caption.length > 0) {
					this.title = '<div class="my-title">' + caption.html() + '</div>';
				}
			}
        });
    }
});