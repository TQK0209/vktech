# Node.js integration

A node server should be up and running, this module will take the default
nodejs_user_$id channel provided by nodejs module to send out notifications.

# Rules integration

After enabling this module you will find two new actions:
- mnc_nodejs_notify_recipients: Send a counter update to users. (+1)
- mnc_nodejs_notify_read_recipients: Send a counter read update to users. (-1)

These can simply be used to notify all users from list<user>.

# Notes
make sure to check your message unread settings before sending out counter
updates. E.G. updating the counter for recpients of a newly created message is
usually fine if you leave everything by default. But if you have use a separate
view for getting the counts - e.g. the notification unread display, you will
have to make that your newly created messages has notification = 1. Otherwise
you will mess up the counters.
