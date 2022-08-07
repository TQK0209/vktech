(function ($) {
  Drupal.behaviors.timeago = {
    attach: function (context) {
      try{
        $.extend($.timeago.settings, Drupal.settings.timeago);
        $('abbr.timeago, span.timeago, time.timeago', context).timeago();
        console.log('timeago run');
      }catch{

      }
    }
  };
})(jQuery);
