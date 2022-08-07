# UI
- [x] lock scroll event on the notification div (dont scroll the window if scroll reached the end)
- [x] css: indicate read/ unread status of a message, better styling of the message "rows" (add some hr and margins), font-size, Box-Header from view?
- [x] icon/badge for displaying notification (two status, all read and unread messages)
- [ ] change default views output to something user friendly "no messages" "no notifications" "no unread messags" "no unread notifications"
- [x] hide counter if 0 / show if > 0 [now possible using CSS]
- [x] make "unread messages" text a variable

# features
- [x] completly cacheable block (despite the unread counts), all action is done via ajax and only on opening the box
- [x] Rules Integration
- [x] load new items at bottom of the scrollable content
- [x] mark loaded items read if shown
- [x] modify the view that is being used for the message notification center through drupal.org/project/variable
- [x] modify the css and js file that is included: drupal_alter: message_notification_center_js, message_notification_center_css, message_notification_center_libraries
- [x] make qtip classes: 'qtip-light qtip-shadow qtip-view', configurable via variable
- [x] create a hook to modify the added javascript and css files (message_notification_center_add_js())
- [x] select the display to use in the settings of the module (list of displays from the selected view) https://drupal.org/node/2043209
- [x] unread display working with load more pager
- [ ] check if all queries have proper indizes
- [x] ajax poll every x seconds to request new notification count
- [x] cache: cache counts of unread messages, reset cache on mark read, variable(module- admin backend) for defining cache lifetime,
  also display information about cache bin on that page, global caching of block possible? split block view and delivering of counts somehow
  page preprocess for delivering the counts
- [x] on close of qtip clear the contents/ make it possbile for ajax link to request a fresh view again
- [x] Add a way to send notifications to all (uid = 0) (was done while adding anonymous user as a recipient)
- [X] node.js counter update on new messages

# full project status:
- [x] make qtip2 library configurable / downloadable, rely on an external module to install it
- [ ] write .api.php
- [ ] feature documentation
- [ ] screenshots
- [ ] screencast?