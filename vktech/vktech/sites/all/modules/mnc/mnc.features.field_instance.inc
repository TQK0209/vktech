<?php
/**
 * @file
 * mnc.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function mnc_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance:
  // 'message-user_notification_center-field_mnc_recipients'
  $field_instances['message-user_notification_center-field_mnc_recipients'] = array(
    'bundle' => 'user_notification_center',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'entityreference',
        'settings' => array(
          'link' => FALSE,
        ),
        'type' => 'entityreference_label',
        'weight' => 0,
      ),
      'mnc' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'message',
    'field_name' => 'field_mnc_recipients',
    'label' => 'Recipients',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'entityreference',
      'settings' => array(
        'match_operator' => 'CONTAINS',
        'path' => '',
        'size' => 60,
      ),
      'type' => 'entityreference_autocomplete',
      'weight' => 2,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Recipients');

  return $field_instances;
}
