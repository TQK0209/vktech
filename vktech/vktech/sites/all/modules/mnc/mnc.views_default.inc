<?php
/**
 * @file
 * mnc.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function mnc_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'mnc';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'message';
  $view->human_name = 'Message Notification Center';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Notifications';
  $handler->display->display_options['css_class'] = 'message-example';
  $handler->display->display_options['use_ajax'] = TRUE;
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['query']['options']['distinct'] = TRUE;
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'load_more';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '5';
  $handler->display->display_options['pager']['options']['quantity'] = '10';
  $handler->display->display_options['pager']['options']['waypoint']['infinite'] = 1;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'entity';
  $handler->display->display_options['row_options']['view_mode'] = 'mnc';
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['label'] = 'No messages created yet';
  $handler->display->display_options['empty']['area']['content'] = 'You should create some activity (manually or with Drush + Devel generate module):

1) Register new users (<code>drush genu 10</code>)
2) Create new content and comments (<code>drush genc 10 5</code>)

';
  $handler->display->display_options['empty']['area']['format'] = 'filtered_html';
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['id'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['table'] = 'field_data_field_mnc_recipients';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['field'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['required'] = TRUE;
  /* Relationship: Flags: mnc_read_message */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'message';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'mnc_read_message';
  $handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
  /* Field: User picture - (Partial 0) */
  $handler->display->display_options['fields']['message_render']['id'] = 'message_render';
  $handler->display->display_options['fields']['message_render']['table'] = 'message';
  $handler->display->display_options['fields']['message_render']['field'] = 'message_render';
  $handler->display->display_options['fields']['message_render']['ui_name'] = 'User picture - (Partial 0)';
  $handler->display->display_options['fields']['message_render']['label'] = '';
  $handler->display->display_options['fields']['message_render']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['message_render']['partials'] = 1;
  $handler->display->display_options['fields']['message_render']['partials_delta'] = '0';
  /* Field: Operation info - (Partial 1) */
  $handler->display->display_options['fields']['message_render_1']['id'] = 'message_render_1';
  $handler->display->display_options['fields']['message_render_1']['table'] = 'message';
  $handler->display->display_options['fields']['message_render_1']['field'] = 'message_render';
  $handler->display->display_options['fields']['message_render_1']['ui_name'] = 'Operation info - (Partial 1)';
  $handler->display->display_options['fields']['message_render_1']['label'] = '';
  $handler->display->display_options['fields']['message_render_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['message_render_1']['partials'] = 1;
  $handler->display->display_options['fields']['message_render_1']['partials_delta'] = '1';
  /* Field: Teaser - (Partial 2) */
  $handler->display->display_options['fields']['message_render_2']['id'] = 'message_render_2';
  $handler->display->display_options['fields']['message_render_2']['table'] = 'message';
  $handler->display->display_options['fields']['message_render_2']['field'] = 'message_render';
  $handler->display->display_options['fields']['message_render_2']['ui_name'] = 'Teaser - (Partial 2)';
  $handler->display->display_options['fields']['message_render_2']['label'] = '';
  $handler->display->display_options['fields']['message_render_2']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['message_render_2']['partials'] = 1;
  $handler->display->display_options['fields']['message_render_2']['partials_delta'] = '2';
  /* Sort criterion: Message: Timestamp */
  $handler->display->display_options['sorts']['timestamp']['id'] = 'timestamp';
  $handler->display->display_options['sorts']['timestamp']['table'] = 'message';
  $handler->display->display_options['sorts']['timestamp']['field'] = 'timestamp';
  $handler->display->display_options['sorts']['timestamp']['order'] = 'DESC';
  /* Contextual filter: User: Uid */
  $handler->display->display_options['arguments']['uid']['id'] = 'uid';
  $handler->display->display_options['arguments']['uid']['table'] = 'users';
  $handler->display->display_options['arguments']['uid']['field'] = 'uid';
  $handler->display->display_options['arguments']['uid']['relationship'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['arguments']['uid']['default_action'] = 'empty';
  $handler->display->display_options['arguments']['uid']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['uid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['uid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['uid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['uid']['break_phrase'] = TRUE;

  /* Display: messages */
  $handler = $view->new_display('block', 'messages', 'messages');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Unread Messages';
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['relationships'] = FALSE;
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['id'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['table'] = 'field_data_field_mnc_recipients';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['field'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['required'] = TRUE;
  /* Relationship: Flags: mnc_read_message */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'message';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['required'] = 0;
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'mnc_read_message';
  $handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
  $handler->display->display_options['menu']['title'] = 'Message example';
  $handler->display->display_options['menu']['description'] = 'Typical UAS (User activity stream).';
  $handler->display->display_options['menu']['weight'] = '0';
  $handler->display->display_options['menu']['context'] = 0;
  $handler->display->display_options['menu']['context_only_inline'] = 0;

  /* Display: messages unread */
  $handler = $view->new_display('block', 'messages unread', 'messages_unread');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Unread Messages';
  $handler->display->display_options['defaults']['relationships'] = FALSE;
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['id'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['table'] = 'field_data_field_mnc_recipients';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['field'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['required'] = TRUE;
  /* Relationship: Flags: mnc_read_message */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'message';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['required'] = 0;
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'mnc_read_message';
  $handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Flags: Flagged */
  $handler->display->display_options['filters']['flagged']['id'] = 'flagged';
  $handler->display->display_options['filters']['flagged']['table'] = 'flagging';
  $handler->display->display_options['filters']['flagged']['field'] = 'flagged';
  $handler->display->display_options['filters']['flagged']['relationship'] = 'flag_content_rel';
  $handler->display->display_options['filters']['flagged']['value'] = '0';

  /* Display: notifications */
  $handler = $view->new_display('block', 'notifications', 'notifications');
  $handler->display->display_options['defaults']['relationships'] = FALSE;
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['id'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['table'] = 'field_data_field_mnc_recipients';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['field'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['required'] = TRUE;
  /* Relationship: Flags: mnc_read_message */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'message';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['required'] = 0;
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'mnc_read_message';
  $handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Message: Notification */
  $handler->display->display_options['filters']['notification']['id'] = 'notification';
  $handler->display->display_options['filters']['notification']['table'] = 'message';
  $handler->display->display_options['filters']['notification']['field'] = 'notification';
  $handler->display->display_options['filters']['notification']['value']['value'] = '1';

  /* Display: notifications unread */
  $handler = $view->new_display('block', 'notifications unread', 'notification_unread');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Unread Notifications';
  $handler->display->display_options['defaults']['relationships'] = FALSE;
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['id'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['table'] = 'field_data_field_mnc_recipients';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['field'] = 'field_mnc_recipients_target_id';
  $handler->display->display_options['relationships']['field_mnc_recipients_target_id']['required'] = TRUE;
  /* Relationship: Flags: mnc_read_message */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'message';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['required'] = 0;
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'mnc_read_message';
  $handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Message: Notification */
  $handler->display->display_options['filters']['notification']['id'] = 'notification';
  $handler->display->display_options['filters']['notification']['table'] = 'message';
  $handler->display->display_options['filters']['notification']['field'] = 'notification';
  $handler->display->display_options['filters']['notification']['value']['value'] = '1';
  /* Filter criterion: Flags: Flagged */
  $handler->display->display_options['filters']['flagged']['id'] = 'flagged';
  $handler->display->display_options['filters']['flagged']['table'] = 'flagging';
  $handler->display->display_options['filters']['flagged']['field'] = 'flagged';
  $handler->display->display_options['filters']['flagged']['relationship'] = 'flag_content_rel';
  $handler->display->display_options['filters']['flagged']['value'] = '0';
  $translatables['mnc'] = array(
    t('Master'),
    t('Notifications'),
    t('more'),
    t('Apply'),
    t('Reset'),
    t('Sort by'),
    t('Asc'),
    t('Desc'),
    t('Items per page'),
    t('- All -'),
    t('Offset'),
    t('« first'),
    t('‹ previous'),
    t('next ›'),
    t('last »'),
    t('No messages created yet'),
    t('You should create some activity (manually or with Drush + Devel generate module):

1) Register new users (<code>drush genu 10</code>)
2) Create new content and comments (<code>drush genc 10 5</code>)

'),
    t('User entity referenced from field_mnc_recipients'),
    t('flag'),
    t('All'),
    t('messages'),
    t('Unread Messages'),
    t('messages unread'),
    t('notifications'),
    t('notifications unread'),
    t('Unread Notifications'),
  );
  $translatables;
  $export['mnc'] = $view;

  return $export;
}
