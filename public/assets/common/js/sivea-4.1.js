$(document).ready(function() {
    var footer = $('footer');
    var footerHeight = footer.outerHeight();// + footer.css('padding-top') + footer.cssValueType('padding-bottom');
    var headerHeight = $('header').height();

    var isTop = function () {
        return $(document).scrollTop() < headerHeight;
    };

    var isBottom = function () {
        return ($(window).innerHeight() + $(document).scrollTop()) > ($(document).innerHeight() - footerHeight);
    };

    var toogleNavbar = function() {
        //$('#scroll').text(footer.css('padding-top').css);
        if (isTop() || isBottom()) {
            $('header').stop().animate({
                top: '0px'
            }, 100);
            $('footer').stop().animate({
                top: $(window).innerHeight() - footerHeight + 'px'
            }, 100);
        } else {
            $('header').stop().animate({
                top: '-' + $('header').height() + 'px'
            }, 100);
            $('footer').stop().animate({
                top: $(window).innerHeight()
            }, 100);
        }
    }

    $(window).scroll(function () {
        toogleNavbar();
    });

    $(window).resize(function() {
        toogleNavbar();
    });

    toogleNavbar();
});


