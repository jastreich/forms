
/*
var smoothScroll = {
    init: function () {

        var navLinks, navSections;

        navLinks = $('.navbar a[href*=#], a.top, a.proc');
        navSections = $('section');

        navLinks.bind('click', function(e) {

            var aTag;
            aTag = $(this);

            $('html, body').stop().animate({
                scrollTop: $(aTag.attr('href')).offset().top - 50
            }, 800, 'easeInOutQuad');
            e.preventDefault();


        });

        navSections
            .waypoint(function(direction) {

                var aLinks = $('.navbar a[href="#' + this.id + '"]');

                aLinks.toggleClass('active', direction === 'down');
                }, {
                    offset: 120
            })

            .waypoint(function(direction) {

                var aLinks = $('.navbar a[href="#' + this.id + '"]');

                aLinks.toggleClass('active', direction === 'up');
            }, {
                offset: function() {
                    return -$(this).height() + 120;
                }
            });

    }
}
*/


var menuMobile = {
	init: function () {
		
		$(window).load(function () {
			pullCheck();
		});
		
		$(window).resize(function () {
			pullCheck();
		});
		
	  function pullCheck() {
	  	
				var pull, menu, menuItem, menuHeight, w;
				
				pull = $('#pull');
				menu = $('.navbar ul');
				menuItem = $('.navbar ul li a')
				menuHeight = menu.height();
				w = $(window).width();
				
				if (w <= 767) {
					
					pull.off('click');
					
					pull.on('click', function (e) {
						 menu.toggleClass('show');
					});
					
					menuItem.on('click', function (e) {
						 menu.removeClass('show');
					});
				
				} else if (w >= 768) {
					pull.off('click');
					menu.removeClass('show');	
				}
		}
		
	}
}


function initialize() {
	//smoothScroll.init();
	menuMobile.init();
}

$(function () {
	initialize();
});
