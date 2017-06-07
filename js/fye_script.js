/**
 * Created by evnguyen on 5/9/2017.
 */
(function ($){
  Drupal.behaviors.convertBehavior = {
    attach: function (context){
      var isIE = window.navigator.userAgent.indexOf("MSIE");
      if (!!navigator.userAgent.match(/Trident\/7\./)){
        $(".alignment").css("float", "left");
      }
    }//End attach
  };
}(jQuery));


