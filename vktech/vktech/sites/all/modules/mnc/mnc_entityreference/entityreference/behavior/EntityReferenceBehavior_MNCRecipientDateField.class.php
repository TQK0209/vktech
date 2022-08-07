<?php

/**
 * Extend an entityreference field to support additional datetime information
 */
class EntityReferenceBehavior_MNCRecipientDateField extends EntityReference_BehaviorHandler_Abstract {

  public function schema_alter(&$schema, $field) {
    $schema['columns']['date'] = array(
      'description' => 'The datetime for which that recipient received the message.',
      'type' => 'text',
      'mysql_type' => 'DATETIME',
      'pgsql_type' => 'timestamp without time zone',
      'sqlite_type' => 'VARCHAR',
      'sqlsrv_type' => 'smalldatetime',
      'not null' => FALSE,
      'default' => NULL,
    );
    $schema['indexes']['date'] = array('date');
  }

  public function settingsForm($field, $instance) {
    return array();
  }

  public function views_data_alter(&$data, $field) {
    // We need to override the default EntityReference table settings when mnc
    // behavior is being used.
    if (mnc_is_date_behaviour_field($field['field_name'])) {
      $entity_types = array_keys($field['bundles']);
      // We need to join the base table for the entities
      // that this field is attached to.
      foreach ($entity_types as $entity_type) {
        // dpm($data);
        // $entity_info = entity_get_info($entity_type);
        $data['field_data_' . $field['field_name']][$field['field_name'] . '_date']['field']['handler'] = 'mnc_handler_field_message_date';
        $data['field_data_' . $field['field_name']][$field['field_name'] . '_date']['filter'] = array(
          'handler' => 'mnc_handler_filter_datetime',
        );
        $data['field_data_' . $field['field_name']][$field['field_name'] . '_date']['argument'] = array(
          'handler' => 'views_handler_argument_date',
          'empty field name' => t('Undated'),
        );
        $data['field_data_' . $field['field_name']][$field['field_name'] . '_date']['sort'] = array(
          'handler' => 'views_handler_sort_date',
        );
      }
    }
  }
}
