<?php

$plugin = array(
  'title' => t('MNC Email'),
  'description' => t('Send Message via email.'),
  'class' => 'MNCNotifierEmail',
  'options' => array(
    // Override recipients. Don't use the email that is assigned to the user.
    // struct:
    /*
     * array(
     *   array(
     *     'user' => 'object', // user object
     *     'mail' => 'alternate mail address' // optional
     *   ),
     * )
     */
    'mnc_recipients' => FALSE,
  ),
   // A notifier must define its own view modes.
   // Those view modes are later going to be rendered and sent.

  # reusing the existing view modes from message_notify
  'view_modes' => array(
    'message_notify_email_subject' => array('label' => t('Message Notify - Email subject')),
    'message_notify_email_body' => array('label' => t('Message Notify - Email body')),
  ),
);
