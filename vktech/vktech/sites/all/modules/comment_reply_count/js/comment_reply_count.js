/**
 * @file
 * Javascript functions.
 */

(function ($) {
  'use strict';
  $(document).ready(() => {
    $('div.indented').css('display', 'none');
    $('div.comment .comment-text ul li.comment-show span.show-hide').click(function () {
      if ((this).innerHTML === 'Show') {
        (this).innerHTML = 'Hide';
        $(this).parents('div.comment').next().slideToggle();
      }
      else {
        (this).innerHTML = 'Show';
        $(this).parents('div.comment').next().slideToggle();
      }
    });
  });
}(jQuery));
