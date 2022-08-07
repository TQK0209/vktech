# Requirements

notes on dependencies:

- requires latest dev version of views_load_more
- requires latest dev version of waypoints

# Recommendations (you really want this!)

Modernizr: If you enable Modernizr mnc will make use of localstorage for caching
requests, the cache time can be configured on the administration pages. This can
help reduce additional client requests for updated counters, together with
nodejs update counter, this works even better. Unless you can not install
Modernizr (for whatever reason), I strongly advice to use it. There is a
fallback solution built in, but that lacks of the caching and peformance
benefits.

# qTip2 Version and jQuery Version:

This module ships a custom version of the qTip 2 library (patched from 2.2.0),
if you want to use the original version or latest version you will currently
require at least to have jQuery 1.6 installed. If you use the latest version of
qTip 2 you will also have to make sure that imagesLoaded is in a version >= 3.x.

You will have to place the newer version in sites/\*/libraries/qtip2/ and make
sure a jquery.qtip.min.js is in there. Version pattern: qTip2.*v([d\.d\.\d]+)

# Known incompatibilities

drupal.org/project/masonry
patch needed: https://drupal.org/node/2022371#comment-7743621 to update
masonry.js to 3.x and imagesLoaded to 3.x

at some state of development I applied this patch to views_load_more, currently
it looks like it is not needed any more (keeping this for reference):

- https://drupal.org/node/1644036#comment-7892491

# Installation

1. install and enable all dependencies (download the dependencies that require
   dev version or patching manually)
2. configure access under /admin/people/permissions related permissions are:
   - Flag message entities as read messages
   - Unflag message entities as read messages
   - access message notification center
   - mark own messages read

# HOW TO TEST

1. install and enable all dependencies (download the dependencies that require
   dev version or patching manually)
2. enable message_example
3. you might have to copy the message texts from the default [und] to the
   language you are using on admin/config/system/message
4. enable devel_generate and populate the database with drush genc 100 10
5. move the new "Message Notification Center: block with unread count and
   message list in a popup div" block to a region
6. clear cache and refresh :)
7. test different settings for the notification center:
   admin/config/mnc

# something about the architecture design

I chose to extend the base message table by one column (notification) in order
to mark a message as a notification, there would have been other ways such as
flagging the node, but I think this way is more performance wise.

# Notifications vs. messages: what's the difference?

There are a few areas within the mnc admin area, and on the provided default
view where there are references to "messages" on the one hand, and to
"notifications," on the other. For instance, the default view has "messages"
and "messages unread" displays, and also "notifications" and
"notifications unread" displays. In the admin UI, mnc asks you to choose a view
display to use as a master, and a display to use for "unread messages."

All these displays can be initially confusing, but they are simply there to
highlight the different ways in which mnc can be used. One can choose to use the
"notification" property of a message (see the note about architecture design,
above) if one wants to usefully separate "notification" messages from other
kinds of messages. Notification messages can then be "marked" as notifications
in code or via rules, and one can use the notification displays provided by the
default mnc view.

The other option, if all of your messages are going to be notifications anyway,
is to ignore the "notification" property entirely, use the "messages" displays,
and treat all messages as notifications.

You can configure which function and view display to be used for populating the
counter at admin/config/mnc.

![counter settings][documentation/unread-messages-unread-notifications.png]

in a custom module you should call for unread items like this:

<code>
<?php  
$callback = variable_get_value('mnc_count_callback');  
$unread_count = call_user_func($callback, $user);  
?>
</code>

# things I would really like to see

- nosql for the counts, read/unread and notification

# FAQ

1. How can I hide the badge if no unread messages are present?

there's a css class you can use for hiding it.
<code>
.mnc-container.no-unread-messages .badge {
  display:none;
}
</code>
or use the other class:
<code>
.mnc-container.no-unread-messages .unread-messages-count {
  display:none;
}
</code>