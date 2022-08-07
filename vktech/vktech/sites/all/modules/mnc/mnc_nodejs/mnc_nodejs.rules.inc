<?php
/**
 * @file
 * Rules for message notification center node.js integration
 */

/**
 * Implements hook_rules_action_info().
 */
function mnc_nodejs_rules_action_info() {
  return array(
    'mnc_nodejs_notify_recipients' => array(
      'label' => t('Send a counter update to users. (+1)'),
      'arguments' => array(
        'users' => array(
          'type' => 'list<user>',
          'label' => t('The users to be notified.'),
        ),
        'message' => array(
          'type' => 'message',
          'label' => t('The message that was created.'),
        ),
      ),
      'module' => 'mnc_nodejs',
      'group' => t('Message'),
    ),
    'mnc_nodejs_notify_read_recipients' => array(
      'label' => t('Send a counter read update to users. (-1)'),
      'arguments' => array(
        'users' => array(
          'type' => 'list<user>',
          'label' => t('The users to be notified.'),
        ),
        'message' => array(
          'type' => 'message',
          'label' => t('The message that was created.'),
        ),
      ),
      'module' => 'mnc_nodejs',
      'group' => t('Message'),
    ),
  );
}

/**
 * Send a counter update to users: (+1).
 *
 * @param array $users
 *   Array of Drupal user object e.g. from user_load().
 * @param object $message
 *   Message entity
 */
function mnc_nodejs_notify_recipients($users, $message) {
  foreach ($users as $account) {
    mnc_nodejs_send_counter_add($account, $message);
  }
}

/**
 * Send a counter read update to users: (-1).
 *
 * @param array $users
 *   Array of Drupal user object e.g. from user_load().
 * @param object $message
 *   Message entity
 */
function mnc_nodejs_notify_read_recipients($users, $message) {
  foreach ($users as $account) {
    mnc_nodejs_send_counter_sub($account, $message);
  }
}
