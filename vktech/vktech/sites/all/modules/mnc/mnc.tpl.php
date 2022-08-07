<?php
/**
 * @file
 * Themes the mnc notifications block.
 *
 * Available variables:
 * - $link_inner_prefix: The inner prefix of the messages unread link.
 *   Can be set in admin settings.
 * - $unread_messages_indicator: Class to indicate whether there are
 *    unread messages or not. Output will be 'has-unread-messages' or
 *    'no-unread-messages'.
 *
 * @see mnc_theme()
 */
?>
<script type="text/javascript">
  var mnc_unread_count_safe = Drupal.mnc.getCountFromCacheSafe();
  var mnc_badge_classes = 'unread-messages-count badge';
  var mnc_container_classes = 'mnc-container <?php print $unread_messages_indicator ?>';

  if (mnc_unread_count_safe) {
    mnc_container_classes += ' has-unread-messages';
  } else {
    mnc_container_classes += ' no-unread-messages';
  }

  var mnc_link_element = '<a id="mnc-link" class="unread-messages-link use-ajax" href="<?php print $callback_url; ?>"><?php print $link_inner_prefix; ?>';
  mnc_link_element = mnc_link_element + '<span class="'+mnc_badge_classes+'">'+mnc_unread_count_safe+'</span>';
  mnc_link_element = mnc_link_element + '</a>';

  var mnc_container = '';
  mnc_container+='<div class="'+mnc_container_classes+'">';
  mnc_container+='  <div class="unread-messages">';
  mnc_container+=     mnc_link_element;
  mnc_container+='  </div>';
  mnc_container+='  <div class="mnc-inner-container">';
  mnc_container+='    <div class="controls"><a href="#" class="markAllRead"><?php print t('mark all read');?></a> | <a href="#" class="markAllUnread"><?php print t('mark all unread');?></a></div>';
  mnc_container+='    <div class="message-view"><div class="ajax-progress ajax-progress-throbber"><div class="throbber">&nbsp;</div></div></div>';
  mnc_container+='   </div>';
  mnc_container+='</div>';
  document.write(mnc_container);
</script>