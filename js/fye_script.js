/**
 * Created by evnguyen on 5/9/2017.
 * @file
 * Extra enhancements to the Find your edge quiz tool
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
      function is_within(string, text){
        //Remove whitespaces
        text = text.replace(/\s/g,'');
        var len = string.length;
        var retval = false;
        for(var i = 0; i < len; i++){
          if(text[i] !== string[i]){
            return retval;
          }
        }
        retval = true;
        return retval;

      }

      var text1 = $("#comp3-text1").text();
      var text2 = $("#comp3-text2").text();
      var text3 = $("#comp3-text3").text();

      if(is_within("Noexperiences", text1)){
        $("#comp3-text1").removeAttr("href");
      }
      if(is_within("Noexperiences", text2)){
        $("#comp3-text2").removeAttr("href");
      }
      if(is_within("Noexperiences", text3)){
        $("#comp3-text3").removeAttr("href");
      }



    }//End attach
  };
}(jQuery));


