<?php
/**
 * @file
 * Contains rules definitions and implementations
 */

/**
 * Implements hook_rules_event_info().
 */
function mnc_rules_event_info() {
  return array(
    'mnc_mark_read' => array(
      'label' => t('A message was read'),
      'module' => 'mnc',
      'arguments' => array(
        'acting_user' => array('type' => 'user', 'label' => t('The user who read the message.')),
        'message' => array('type' => 'int', 'label' => t('The message id of the message which was read.')),
      ),
      'group' => t('Message'),
    ),
    'mnc_mark_all_read' => array(
      'label' => t('All message were marked read'),
      'module' => 'mnc',
      'arguments' => array(
        'acting_user' => array('type' => 'user', 'label' => t('The user who marked the messages.')),
      ),
      'group' => t('Message'),
    ),
    'mnc_mark_unread' => array(
      'label' => t('A message was marked as unread'),
      'module' => 'mnc',
      'arguments' => array(
        'acting_user' => array('type' => 'user', 'label' => t('The user who unread the message.')),
        'message' => array('type' => 'int', 'label' => t('The message id of the message which was marked unread.')),
      ),
      'group' => t('Message'),
    ),
    'mnc_mark_all_unread' => array(
      'label' => t('All message were marked unread'),
      'module' => 'mnc',
      'arguments' => array(
        'acting_user' => array('type' => 'user', 'label' => t('The user who marked the messages.')),
      ),
      'group' => t('Message'),
    ),
  );
}

/**
 * Implements hook_rules_action_info().
 */
function mnc_rules_action_info() {
  return array(
    'mnc_action_read_message' => array(
      'label' => t('Mark a message read'),
      'arguments' => array(
        'user' => array('type' => 'user', 'label' => t('The user who reads the message.')),
        'message' => array('type' => 'message', 'label' => t('The message object.')),
      ),
      'module' => 'mnc',
      'group' => t('Message'),
    ),
    'mnc_action_unread_message' => array(
      'label' => t('Mark a message unread'),
      'arguments' => array(
        'user' => array('type' => 'user', 'label' => t('The user who unreads the message.')),
        'message' => array('type' => 'message', 'label' => t('The message object.')),
      ),
      'module' => 'mnc',
      'group' => t('Message'),
    ),
    'mnc_action_load_anonymous_user' => array(
      'label' => t('Load anonymous user object'),
      'provides' => array(
        'anonymous_user' => array(
          'type' => 'user',
          'label' => t('anonymous user'),
        ),
      ),
      'module' => 'mnc',
      'group' => t('User'),
    ),
  );
}

/**
 * Marks a message read for a given user.
 *
 * @param object $user
 *   Drupal user object e.g. from user_load().
 * @param object $message
 *   Message entity
 */
function mnc_action_read_message($user, $message) {
  mnc_read($user->uid, $message->mid);
}

/**
 * Marks a message unread for a given user.
 *
 * @param object $user
 *   Drupal user object e.g. from user_load().
 * @param object $message
 *   Message entity
 */
function mnc_action_unread_message($user, $message) {
  mnc_unread($user->uid, $message->mid);
}

/**
 * Creates an anonymous user object.
 *
 * @return object
 *   Anonymous drupal user object
 */
function mnc_action_load_anonymous_user() {
  return array('anonymous_user' => drupal_anonymous_user());
}
