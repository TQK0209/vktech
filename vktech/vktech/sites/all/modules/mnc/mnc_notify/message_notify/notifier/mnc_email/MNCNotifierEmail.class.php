<?php

/**
 * Email notifier.
 */
class MNCNotifierEmail extends MessageNotifierBase {

  public function send() {
    $message = $this->message;
    $output = array();


    $plugin = $this->plugin;
    $options = $plugin['options'];

    $recipients = array();
    if ($options['mnc_recipients']) {
      // recipients are provided by options
      // struct:
      /*
       * array(
       *   array(
       *     'user' => 'object',
       *     'mail' => 'alternate mail address'
       *   ),
       * )
       */
      $recipients = array();
      foreach ($options['mnc_recipients'] as &$recipient) {
        // provide a default mail address
        if (!isset($recipient['mail'])) {
          $recipient['mail'] = $recipient['user']->mail;
        }
        $recipients[] = $recipient;
      }
    } elseif(property_exists($message, 'mnc_recipients')) {
      if (empty($message->mnc_recipients)) {
        // no recipients exit.
        return;
      } else {
        foreach ($message->mnc_recipients[LANGUAGE_NONE] as $value) {
          $user = user_load($value['target_id']);
          if ($user) {
            $recipient = array(
              'user' => $user,
            );
            $recipient['mail'] = $recipient['user']->mail;
            $recipients[] = $recipient;
          }
        }
      }
    } else {
      // no recipients field found or provided.
      // @Todo: should we fail/ fail silently here?
      return;
    }

    // attach the recipients to the message object
    $message->recipients = $recipients;
    $results = array();

    foreach ($message->recipients as $recipient) {
      // Todo: figure out why token replacement for custom token doesnt seem to work
      //       I cant get a custom replace ment for [message:recipient] to work, so all I got
      //       left to help you folks is adding it to the message itself so you might access
      //       it in a template file :(
      //       also !replace_me with argument callback is only called on message creation, not
      //       on rendering, so only thing I could do from now is providing hardcoded default
      //       replacements :(

      $message->recipient = $recipient;
      foreach ($this->plugin['view_modes'] as $view_mode => $value) {
        // attach recipient variables
        #$message->content['recipient'] = array(
        #  '#theme' => $recipient
        #);
        $content = $message->buildContent($view_mode);
        $output[$view_mode] = render($content);

        // token replacement
        $output[$view_mode] = str_replace('[recipient:uid]', $recipient['user']->uid, $output[$view_mode]);
        $output[$view_mode] = str_replace('[recipient:name]', $recipient['user']->name, $output[$view_mode]);
        $output[$view_mode] = str_replace('[recipient:mail]', $recipient['user']->mail, $output[$view_mode]);
        $context = array(
          'message' => $message,
          'view_mode' => $view_mode,
        );
        drupal_alter('mnc_notify_email_text', $output[$view_mode], $context);
      }
      $result = $this->deliver($output);
      $results[] = $result;
      $this->postSend($result, $output);
    }
    return $results;
  }

  public function deliver(array $output = array()) {
    $plugin = $this->plugin;
    $message = $this->message;

    $options = $plugin['options'];

    $account = $message->recipient['user'];
    $mail = $message->recipient['mail'];

    $languages = language_list();
    if (!$options['language override']) {
      $lang = !empty($account->language) && $account->language != LANGUAGE_NONE ? $languages[$account->language]: language_default();
    }
    else {
      $lang = $languages[$message->language];
    }

    // The subject in an email can't be with HTML, so strip it.
    $output['message_notify_email_subject'] = strip_tags($output['message_notify_email_subject']);

    // Pass the message entity along to hook_drupal_mail().
    $output['message_entity'] = $message;

    $result =  drupal_mail('message_notify', $message->type, $mail, $lang, $output);
    return $result['result'];
  }

  /**
   * Act upon send result.
   *
   * - Save the rendered messages if needed.
   * - Invoke watchdog error on failure.
   */
  public function postSend($result, array $output = array()) {
    $plugin = $this->plugin;
    $message = $this->message;

    $options = $plugin['options'];

    $save = FALSE;
    if (!$result) {
      watchdog('message_notify', t('Could not send message using @title to user ID @uid.'), array('@label' => $plugin['title'], '@uid' => $message->recipient->uid), WATCHDOG_ERROR);
      if ($options['save on fail']) {
        $save = TRUE;
      }
    }
    elseif ($result && $options['save on success']) {
      $save = TRUE;
    }

    if ($options['rendered fields']) {
      // Save the rendered output into matching fields.
      $wrapper = entity_metadata_wrapper('message', $message);
      foreach ($this->plugin['view_modes'] as $view_mode => $mode) {
        if (empty($options['rendered fields'][$view_mode])) {
          throw new MessageNotifyException(format_string('The rendered view mode @mode cannot be saved to field, as there is not a matching one.', array('@mode' => $mode['label'])));
        }
        $field_name = $options['rendered fields'][$view_mode];

        if (!$field = field_info_field($field_name)) {
          throw new MessageNotifyException(format_string('Field @field does not exist.', array('@field' => $field_name)));
        }

        // Get the format from the field. We assume the first delta is the
        // same as the rest.
        if (empty($wrapper->{$field_name}->format)) {
          $wrapper->{$field_name}->set($output[$view_mode]);
        }
        else {
          $format = $wrapper->type->{MESSAGE_FIELD_MESSAGE_TEXT}->get(0)->format->value();
          $wrapper->{$field_name}->set(array('value' => $output[$view_mode], 'format' => $format));
        }
      }
    }

    if ($save) {
      // Todo: how should we handle failed message saves?
      // $message->save();
    }
  }
}
