<?php
/**
 * @file
 * Contains some of the api functions which may be useful for other modules
 */

/**
 * Marks a message read for a given user.
 *
 * @param object $user
 *   Drupal user object e.g. from user_load().
 * @param object $message
 *   Message entity
 */
function mnc_read($user, $message) {

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

}

/**
 * Alter the array that is send to drupal_add_js.
 */
function hook_mnc_js($js) {

}

/**
 * Alter the array that is send to drupal_add_css.
 */
function hook_mnc_css($js) {

}

/**
 * Alter the array that is send to drupal_add_library.
 */
function hook_mnc_libraries($libraries) {

}
