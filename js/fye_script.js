/**
 * Created by evnguyen on 5/9/2017.
 */
(function ($){
  Drupal.behaviors.convertBehavior = {
    attach: function (context){

      /*var isIE = window.navigator.userAgent.indexOf("MSIE");
      if (!!navigator.userAgent.match(/Trident\/7\./)){
        $(".alignment").css("float", "left");
      }*/
      $('.webform-next').css("float","right");
      $('.webform-previous').css("float","none");
      $('.button-primary').css("float","right");

      $(window).resize(function() {
        var width = $(window).width();
        if(width < 800){
          $('.webform-next').css("float","");
          $('.webform-previous').css("float","");
          $('.button-primary').css("float","");
        }
        else{
          $('.webform-next').css("float","right");
          $('.webform-previous').css("float","none");
          $('.button-primary').css("float","right");
        }
      });

    }//End attach
  };
}(jQuery));


