(function($) {

    'use strict';

    $(document).ready(function() {
      var t0 = performance.now();

        // Comments
        $('.commentlist li').addClass('card');
        $('.comment-reply-link').addClass('btn btn-secondary');

        // Forms
        $('select, input[type=text], input[type=email], input[type=password], textarea').addClass('form-control');
        $('input[type=submit]').addClass('btn btn-primary');

        // Pagination fix for ellipsis
        $('.pagination .dots').addClass('page-link').parent().addClass('disabled');

        // You can put your own code in here

        /*** Remove blue bar when previous button is clicked on checkout page ***/
        $("[href='#previous']").click(function() {
            $(".current").next().removeClass("done");
        });
        /*** END ***/

        function addClassesMobile($when) {
            $(window).on($when, function() {
                if ($(window).width() < 992) {
                    $("#fixed-top-header").addClass("navbar navbar-default navbar-fixed-top");
                    $(".festi-cart-text-before-quantity").html("(");
                } else {
                    $("#fixed-top-header").removeClass("navbar navbar-default navbar-fixed-top");
                    $(".festi-cart-text-before-quantity").html("VIEW CART (");
                }
            })
        }
        addClassesMobile('load');
        addClassesMobile('resize');

        var t1 = performance.now();
        console.log("document.ready() took " + (t1-t0) + " milliseconds." );
        //alert("hello" );

    });

}(jQuery));
