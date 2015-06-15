jQuery(function($){

    $('.has-sub-menu').on('mouseenter', function(){
        $(this).addClass('hover');
        $(this).find('> a > i').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
    });
    $('.has-sub-menu > a > i').on('click', function(e){
        e.preventDefault();
        var li = $(this).parent().parent();
        if(li.hasClass('hover')) {
            li.removeClass('hover');
            $(this).removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
        }
        else {
            li.addClass('hover');
            $(this).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
        }
    });

    $(window).on('load scroll', function(){
        if($(window).scrollTop() > 90) {
            $('.top-fix').addClass('down');
        }
        else {
            $('.top-fix').removeClass('down');
        }
    });

  $('html').removeClass('no-js'); 
  
  $('ul.styles > li').click(function(){
      var className = $(this).attr('class');
      $('body').removeClass('theme-style-0 theme-style-1 theme-style-2 theme-style-3');
      $('body').addClass(className);
    });

  $('li:last-child, .product-listing > div:last-child').addClass('lastItem');
  $('li:first-child, .product-listing > div:first-child').addClass('firstItem');
  

  /* Dropdown menu */
  $('ul.sf-menu').supersubs({
      minWidth:    12,   // minimum width of submenus in em units
      maxWidth:    27,   // maximum width of submenus in em units
      extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
    }).superfish({
      animation: { height: 'show' }, // slide-down animation
      speed: 'fast' // faster animation speed
  });

  $('.sf-menu').mobileMenu({
    defaultText: 'MENU'
  });

  var ismobile = navigator.userAgent.match(/(iPhone)|(iPod)|(android)|(webOS)/i)
    if(ismobile){
      $('.sf-menu').sftouchscreen();
    }


  /* Placeholder JS */
  /*==========================*/

  $('[placeholder]').each(function(){
    if ($(this).val() === '') {
      var hint = $(this).attr('placeholder');
      $(this).val(hint).addClass('hint');
    }
  });

  $('[placeholder]').focus(function() {
    if ($(this).val() === $(this).attr('placeholder')) {
      $(this).val('').removeClass('hint');
    }
  }).blur(function() {
    if ($(this).val() === '') {
      $(this).val($(this).attr('placeholder')).addClass('hint');
    }
  });                    

  /* Form validation JS */
  /*==========================*/

  $('input.error, textarea.error').focus(function() {
    $(this).removeClass('error');
  });

  $('form :submit').click(function() {
    $(this).parents('form').find('input.hint, textarea.hint').each(function() {
      $(this).val('').removeClass('hint');
    });
    return true;
  }); 
 
   
   /*Form styles*/  
  $('.address_table form, .customer_address form').addClass('form-horizontal');


  /*Social icons*/

  $('.template-customers-login').find('.errors').addClass('alert').addClass('alert-danger');




});
