<?php
/**
 * @file
 * mnc.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function mnc_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function mnc_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_flag_default_flags().
 */
function mnc_flag_default_flags() {
  $flags = array();
  // Exported flag: "read messages".
  $flags['mnc_read_message'] = array(
    'entity_type' => 'message',
    'title' => 'read messages',
    'global' => 0,
    'types' => array(),
    'errors' => array(),
    'flag_short' => 'mark this read',
    'flag_long' => '',
    'flag_message' => '',
    'unflag_short' => 'mark this unread',
    'unflag_long' => '',
    'unflag_message' => '',
    'unflag_denied_text' => '',
    'link_type' => 'toggle',
    'weight' => 0,
    'show_in_links' => array(
      'full' => 0,
      'diff_standard' => 0,
      'token' => 0,
    ),
    'show_as_field' => 0,
    'show_on_form' => 0,
    'access_author' => '',
    'show_contextual_link' => 0,
    'module' => 'mnc',
    'locked' => array(
      0 => 'name',
    ),
    'api_version' => 3,
  );
  return $flags;

}

/**
 * Implements hook_default_message_type().
 */
function mnc_default_message_type() {
  $items = array();
  $items['user_notification_center'] = entity_import('message_type', '{
    "name" : "user_notification_center",
    "description" : "user notification center",
    "argument_keys" : [],
    "argument" : [],
    "category" : "message_type",
    "data" : {
      "token options" : { "clear" : 0 },
      "purge" : { "override" : 0, "enabled" : 0, "quota" : "", "days" : "" }
    },
    "language" : "",
    "arguments" : null,
    "message_text" : { "und" : [
        {
          "value" : "[message:mid] [message:type] [message:user]",
          "format" : "filtered_html",
          "safe_value" : "\\u003Cp\\u003E[message:mid] [message:type] [message:user]\\u003C\\/p\\u003E\\n"
        }
      ]
    },
    "rdf_mapping" : []
  }');
  return $items;
}
