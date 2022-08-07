# hardcoded recipient replacements

since I couldnt get token support working I am providing 3 custom replacements within message texts,
that will be processed during message sending:

- [recipient:uid]
- [recipient:name]
- [recipient:mail]

you can hook in the text generation right before it's passed to delivery using:

function hook_mnc_notify_email_text_alter(&$text, $context) {
  $context['message'];
  $context['view_mode'];
}

do not alter the message object - unless you know what you are doing...