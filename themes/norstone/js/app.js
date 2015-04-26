// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$(function(){
	//dropdown choose the product
	$('#drop-view').click(function(){
		$( '#'+ $(this).data('target')).slideToggle();
	});

	//search form responsive (641 to 1023)	
	$('#search-box button').click(function(){
		var w = $( window ).width();
		if (w > 640 && w < 1024){
			$(this).parent().toggleClass('show');
		}
	});
	$( window ).resize(function() {
  		//reset display search box
  		$('#search-box').removeClass('show');
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
				this.title = '<div class="my-title">'+$(this.element).siblings('div').html()+'</div>';
			}
        });
    }
});