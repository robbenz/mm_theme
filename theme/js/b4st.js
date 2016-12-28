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
          if($("#festi-cart").is(":visible")) {
            $(".festi-cart-text-before-quantity").html("(");
          } else {
            setTimeout(cartModifier, 50);
          }
        }
        /*** END ***/

        /*** Header classes for mobile Nav ***/
        function addClassesMobile($when) {
            $(window).on($when, function() {
              function viewport() {
                  var e = window, a = 'inner';
                  if (!('innerWidth' in window )) {
                      a = 'client';
                      e = document.documentElement || document.body;
                  }
                  return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
              }

              var vpWidth = viewport().width; // This should match your media query

                if (vpWidth < 992) {
                    $("#fixed-top-header").addClass("navbar navbar-default navbar-fixed-top");
                    cartModifier();
                } else {
                    $("#fixed-top-header").removeClass("navbar navbar-default navbar-fixed-top");
                    $(".festi-cart-text-before-quantity").html("VIEW CART (");
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
              $($inputField+"_field").append("<p class='red-alert'>Maximum Length Reached</p>");
              $(".red-alert").hide(2000, function() {
              });
            }
          });
        }
        FUauthorize_net("#billing_address_1", 60)
        FUauthorize_net("#billing_company", 50)
        /*** END ***/

    });

}(jQuery));
