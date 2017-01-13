(function($) {

    'use strict';

    $(document).ready(function() {

        // Comments
        $('.commentlist li').addClass('card');
        $('.comment-reply-link').addClass('btn btn-secondary');

        // Forms
          $('select, input[type=text], input[type=email], input[type=password], textarea').addClass('form-control');
        $('input[type=submit]').addClass('btn btn-primary');

        // Pagination fix for ellipsis
        $('.pagination .dots').addClass('page-link').parent().addClass('disabled');

        /*** Remove blue bar when previous button is clicked on checkout page ***/
        $("[href='#previous']").click(function() {
            $(".current").next().removeClass("done");
        });


        /*** END ***/

        /*** Check for festi cart ***/
        function cartModifier() {
            if ($("#festi-cart").is(":visible")) {
              $(".festi-cart-text-before-quantity").html("(");
              if ($(".festi-cart-text-after-quantity").is(":hidden")){
                    $(".festi-cart-icon").attr("src", "//localhost:8888/medmattress/wp-content/plugins/woocommerce-woocartpro/static/images/icons/user/icon13.png")
              }
            } else {
              setTimeout(cartModifier, 50);
            }
        }
        /*** END ***/
        function hideableHeader() { //hides the header when an input field is focused
            $(document).on('focus', 'input[type="text"], input[type="password"], input[type="email"], input[type="tel"], textarea', function() {
                var inputID = $(this).attr('id');
                if (inputID != "s" && inputID != "user_login" && inputID != "user_pass") { //don't run if input field is the search bar, login, or password in the header
                    $("#fixed-top-header").stop().slideUp(200);
                    $("#landing_nav, #searchform, .responsive-menu-inner").stop().hide();
                }
            });

            //show header when input is NOT on focus
            $(document).on('blur', 'input[type="text"], input[type="email"],input[type="password"], input[type="tel"], textarea', function() { //shows header when an input field is not in focus
                $("#fixed-top-header").stop().slideDown(200, function() {
                  $("#landing_nav").stop().slideDown();
                  $("#searchform, .responsive-menu-inner").stop().show();
                });
            });
        }

        /*** Hide coupon on payment page ***/
        function couponHider(){
          if($(".finish-btn").is(":visible")){
            $("#post_7 .woocommerce-info").hide();
            setTimeout(couponHider, 50);
          } else {
            $("#post_7 .woocommerce-info").show();
            setTimeout(couponHider, 50);
          }
        }
        couponHider();

        /*** Header classes for mobile Nav ***/
        function addClassesMobile($when) {
            $(window).on($when, function() {
                function viewport() {
                    var e = window,
                        a = 'inner';
                    if (!('innerWidth' in window)) {
                        a = 'client';
                        e = document.documentElement || document.body;
                    }
                    return {
                        width: e[a + 'Width'],
                        height: e[a + 'Height']
                    };
                }

                var vpWidth = viewport().width; // This should match your media query

                if (vpWidth < 992 || $(window).width() < 992) {
                    $("#fixed-top-header").addClass("navbar navbar-default navbar-fixed-top");
                    cartModifier();
                    hideableHeader();
                } else {
                    $("#fixed-top-header").removeClass("navbar navbar-default navbar-fixed-top");
                    $(".festi-cart-text-before-quantity").html("VIEW CART (");
                    $(".festi-cart-icon").attr("src", "//localhost:8888/medmattress/wp-content/plugins/woocommerce-woocartpro/static/images/icons/user/icon11.png");
                    $(document).off('focus', 'input[type="text"], input[type="password"], input[type="email"], input[type="tel"], textarea'); //removes the event binder for hideableHeader
                }
            })
        }

        addClassesMobile('load');
        addClassesMobile('resize');
        /*** END ***/

        /*** Max Length for checkout shipping input field ***/
        function FUauthorize_net($inputField, $maxLen) {
            $($inputField).attr("maxlength", $maxLen);
            $($inputField).on("keyup", function() {
                if ($(this).val().length == $maxLen) {
                    $(".red-alert").remove();
                    $($inputField + "_field").append("<p class='red-alert'>Maximum Length Reached</p>");
                    $(".red-alert").hide(2000, function() {});
                }
            });
        }
        FUauthorize_net("#billing_address_1", 60)
        FUauthorize_net("#billing_company", 50)
            /*** END ***/


        $("#premium-foam").append("</br><img class='most-popular' src='http://medmattress.com/wp-content/uploads/2017/01/most_popular.png'/>");

        /*** makes images update radio button on custom sizing form ***/
        var radioID = "#vfb-field-24-0, #vfb-field-24-1, #vfb-field-24-2";
        $(radioID).click(function() { // any element can update any radio as long as their id's match
            var imgID = $(this).attr('id'); //the id of the thing that is clicked
            $('#' + imgID).attr("checked", true); //checks correct radio button
        });
        /*** END ***/

    });

}(jQuery));
