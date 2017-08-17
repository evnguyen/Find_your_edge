/**
 * Created by evnguyen on 5/9/2017.
 * @file
 * Extra enhancements to the Find your edge quiz tool
 */
(function ($) {
  Drupal.behaviors.convertBehavior = {
    attach: function (context) {

      var width = $(window).width();
      if (width > 983) {
        $('.text-box-hover-wrapper').hide();
        $('#redo-hover-area').hover(
          function(){
            $('.text-box-hover-wrapper').show();
          },
          function(){
            $('.text-box-hover-wrapper').hide();
          }
        );
        $('#redo-button-href').focus(
          function(){
            $('.text-box-hover-wrapper').show();
          }
        );
        $('#redo-button-href').blur(
          function(){
            $('.text-box-hover-wrapper').hide();
          }
        );
      }
      $(window).resize(function() {
        var width = $(window).width();
        if (width < 983) {
          $('.text-box-hover-wrapper').show();
          $('#redo-hover-area').off('hover')
        }
        else {
          $('.text-box-hover-wrapper').hide();
          $('#redo-hover-area').hover(
            function(){
              $('.text-box-hover-wrapper').show();
            },
            function(){
              $('.text-box-hover-wrapper').hide();
            }
          );
          $('#redo-button-href').focus(
            function(){
              $('.text-box-hover-wrapper').show();
            }
          );
          $('#redo-button-href').blur(
            function(){
              $('.text-box-hover-wrapper').hide();
            }
          );
        }
      });

      /*
       var width = $(window).width();
      if (width < 983) {
        $('.webform-next, .webform-previous, .button-primary').css({
          'float':'',
          'width':'100%'
        });
      }
      else {
        $('.webform-next, .button-primary').css({
          'float':'right',
          'width':'30%'
        });
        $('.webform-previous').css({
          'float':'none',
          'width':'30%'
        });
        $('.webform-next').css({
          'float':'right',
          'width':'30%'
        });
        $('.text-box-hover-wrapper').hide();
        $('#redo-hover-area').hover(
          function(){
            $('.text-box-hover-wrapper').show();
          },
          function(){
            $('.text-box-hover-wrapper').hide();
          }
        );
      }
      $(window).resize(function() {
        var width = $(window).width();
        if (width < 983) {
          $('.webform-next, .webform-previous, .button-primary').css({
            'float':'',
            'width':'100%'
          });
          $('.text-box-hover-wrapper').show();
          $('#redo-hover-area').off('hover')
        }
        else {
          $('.webform-next, .button-primary').css({
            'float':'right',
            'width':'30%'
          });
          $('.webform-previous').css({
            'float':'none',
            'width':'30%'
          });
          $('.webform-next').css({
            'float':'right',
            'width':'30%'
          });
          $('.text-box-hover-wrapper').hide();
          $('#redo-hover-area').hover(
            function(){
              $('.text-box-hover-wrapper').show();
            },
            function(){
              $('.text-box-hover-wrapper').hide();
            }
          );
        }
      });
       */
    }//End attach
  };
}(jQuery));


