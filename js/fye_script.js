/**
 * Created by evnguyen on 5/9/2017.
 */
(function ($){
  Drupal.behaviors.convertBehavior = {
    attach: function (context){
      var width = $(window).width();
      if(width < 900){
        $('input[type=submit]').css("width", "100%");
        $('.webform-next').css("float","");
        $('.webform-previous').css("float","");
        $('.button-primary').css("float","");
      }
      else{
        $('input[type=submit]').css("width", "30%");
        $('.webform-next').css("float","right");
        $('.webform-previous').css("float","none");
        $('.button-primary').css("float","right");
      }

      $(window).resize(function() {
        var width = $(window).width();
        if(width < 900){
          $('input[type=submit]').css("width", "100%");
          $('.webform-next').css("float","");
          $('.webform-previous').css("float","");
          $('.button-primary').css("float","");
        }
        else{
          $('input[type=submit]').css("width", "30%");
          $('.webform-next').css("float","right");
          $('.webform-previous').css("float","none");
          $('.button-primary').css("float","right");
        }
      });

      /**
       * Determines if string is a substring of text
       * @param string
       * @param text
       */
      function isWithin(string, text){
        var len = string.length;
        var retval = false;
        for(var i = 0; i < len; i++){
          if(text[i] != string[i]){
            return retval;
          }
        }
        retval = true;
        return retval;
      }

      var text = $(".comp-text").text();
      if(isWithin("No experiences", text)){
        $(".comp-text").removeAttr("href");
      }



    }//End attach
  };
}(jQuery));


