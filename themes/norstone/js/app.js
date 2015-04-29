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

jQuery.extend({
    highlight: function (node, re, nodeName, className) {
        if (node.nodeType === 3) {
            var match = node.data.match(re);
            if (match) {
                var highlight = document.createElement(nodeName || 'span');
                highlight.className = className || 'highlight';
                var wordNode = node.splitText(match.index);
                wordNode.splitText(match[0].length);
                var wordClone = wordNode.cloneNode(true);
                highlight.appendChild(wordClone);
                wordNode.parentNode.replaceChild(highlight, wordNode);
                return 1; //skip added node in parent
            }
        } else if ((node.nodeType === 1 && node.childNodes) && // only element nodes that have children
            !/(script|style)/i.test(node.tagName) && // ignore script and style nodes
            !(node.tagName === nodeName.toUpperCase() && node.className === className)) { // skip if already highlighted
            for (var i = 0; i < node.childNodes.length; i++) {
                i += jQuery.highlight(node.childNodes[i], re, nodeName, className);
            }
        }
        return 0;
    }
});

jQuery.fn.unhighlight = function (options) {
    var settings = { className: 'highlight', element: 'span' };
    jQuery.extend(settings, options);

    return this.find(settings.element + "." + settings.className).each(function () {
        var parent = this.parentNode;
        parent.replaceChild(this.firstChild, this);
        parent.normalize();
    }).end();
};

jQuery.fn.highlight = function (words, options) {
    var settings = { className: 'highlight', element: 'span', caseSensitive: false, wordsOnly: false };
    jQuery.extend(settings, options);

    if (words.constructor === String) {
        words = [words];
    }
    words = jQuery.grep(words, function(word, i){
        return word !== '';
    });
    words = jQuery.map(words, function(word, i) {
        return word.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    });
    if (words.length === 0) { return this; }

    var flag = settings.caseSensitive ? "" : "i";
    var pattern = "(" + words.join("|") + ")";
    if (settings.wordsOnly) {
        pattern = "\\b" + pattern + "\\b";
    }
    var re = new RegExp(pattern, flag);

    return this.each(function () {
        jQuery.highlight(this, re, settings.element, settings.className);
    });
};