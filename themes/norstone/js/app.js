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
		w = $( window ).width();
		if (w > 640 && w < 1024){
			$(this).parent().toggleClass('show');
		}
	});
	$( window ).resize(function() {
  		//reset display search box
  		$('#search-box').removeClass('show');
  	});

  	//gallery large view
  	/*
  	$(".view-large").click(function() 
	{
		index = $(this).parents("li").index();
		$("#large-gallery li a :eq("+index+")").trigger('click');

	});*/
});