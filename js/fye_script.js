/**
 * Created by evnguyen on 5/9/2017.
 * @file
 * Extra enhancements to the Find your edge quiz tool
 */
(function ($) {
  Drupal.behaviors.convertBehavior = {
    attach: function (context) {
      var width = $(window).width();
      if (width < 1000) {
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
      }

      $(window).resize(function() {
        var width = $(window).width();
        if (width < 1000) {
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
        }
      });
    }//End attach
  };
}(jQuery));


