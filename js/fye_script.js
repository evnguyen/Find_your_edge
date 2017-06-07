/**
 * Created by evnguyen on 5/9/2017.
 */
(function ($){
  Drupal.behaviors.convertBehavior = {
    attach: function (context){
      $(".call-to-action-theme-gray:hover").css("background-color","red");
    }//End attach
  };
}(jQuery));