$(document).ready(function(){
	$('.hamburger-shell').click(function(){
		$('#nav-icon3').toggleClass('open');
	});
});

$(document).ready(function(){
	$('.hamburger-shell').click(function(){
		$('#menu').slideToggle(300);
		$('.bg-cover').toggleClass('reveal');
	});
	$('.bg-cover').click(function(){
		$('#menu').slideToggle(300);
		$('.bg-cover').toggleClass('reveal');
	})
});

$(document).ready(function() {

    /* Every time the window is scrolled ... */
    $(window).scroll( function(){

        /* Check the location of each desired element */
        $('.services-item').each( function(i){

            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the object is completely visible in the window, fade it it */
            if( bottom_of_window > bottom_of_object ){

                $(this).animate({'opacity':'1'},500);

            }

        });

    });

});



/*jQuery(function($) {

    "use strict";

    var win = $(window)
        , target = $('body')
        , wrapper = target.find('> div')
        , easing = "ease-out" //css easing
        , duration = "1.2s" //duration ms(millisecond) or s(second)
        , top = 0
        , resizeTimeout
        , jmScroll = {
            _init: function() {
                if( wrapper.length == 1 ) {
                    target.css({
                        margin: '0',
                        padding: '0',
                        width: '100%',
                        height: wrapper.height() + 'px'
                    });

                    wrapper.css({
                        transition: 'transform ' + duration + ' ' + easing,
                        position: 'fixed',
                        top: '0',
                        left: '0',
                        width: '100%',
                        padding: '0',
                        zIndex: '2',
                        display: 'block',
                        backfaceVisibility: 'hidden'
                    });

                    jmScroll._reFlow(function() {
                        jmScroll._scroll();
                    });
                }
            },

            _scroll: function() {
                top = win.scrollTop();
                wrapper.css('transform', 'translateY(-' + top + 'px)');
            },

            _reFlow: function(callback) {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    target.height(wrapper.height());

                    var getType = {};
                    var isCallback = callback && getType.toString.call(callback) === '[object Function]';

                    if(isCallback) {
                        callback();
                    }
                }, 200);
            }
        };

    if (typeof window.ontouchstart == 'undefined') {
        win.on({
            scroll: function () {
                jmScroll._scroll();
            }
            , resize: function() {
                jmScroll._reFlow();
            }
            , load: function() {
                jmScroll._init();
            }
        });
    }
});*/
