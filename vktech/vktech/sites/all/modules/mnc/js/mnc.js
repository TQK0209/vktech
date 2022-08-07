(function($) {
  // on is added in jQuery version 1.7 and from then on the preferred method to bind events
  var iCanUseOn = !!$.fn.on;

  Drupal.mnc = {};

  Drupal.mnc.markReadSuccess = function(data) {
    $.event.trigger('flagGlobalBeforeMarkReadSuccess', [data]);
    Drupal.mnc.setCount(data.unread);
    $.event.trigger('flagGlobalAfterMarkReadSuccess', [data]);
  }

  Drupal.mnc.markUnreadSuccess = function(data) {
    $.event.trigger('flagGlobalBeforeMarkUnreadSuccess', [data]);
    Drupal.mnc.setCount(data.unread);
    $.event.trigger('flagGlobalAfterMarkUnreadSuccess', [data]);
  }

  Drupal.mnc.markAllReadSuccess = function(data) {
    $.event.trigger('flagGlobalBeforeMarkAllReadSuccess', [data]);
    Drupal.mnc.setCount(0);
    $.event.trigger('flagGlobalAfterMarkAllReadSuccess', [data]);
  }

  Drupal.mnc.markAllUnreadSuccess = function(data) {
    $.event.trigger('flagGlobalBeforeMarkAllUnreadSuccess', [data]);
    Drupal.mnc.setCount(data.unread);
    $.event.trigger('flagGlobalAfterMarkAllUnreadSuccess', [data]);
  }

  Drupal.mnc.markRead = function(message_id) {
    $.ajax({
      type: 'POST',
      url: Drupal.settings.basePath + 'mnc/ajax/read',
      dataType: 'json',
      success: Drupal.mnc.markReadSuccess,
      data: {"message_id":message_id}
    });
  }

  Drupal.mnc.markUnread = function(message_id) {
    $.ajax({
      type: 'POST',
      url: Drupal.settings.basePath + 'mnc/ajax/unread',
      dataType: 'json',
      success: Drupal.mnc.markUnreadSuccess,
      data: {"message_id":message_id}
    });
  }

  Drupal.mnc.markAllRead = function() {
    $.ajax({
      type: 'POST',
      url: Drupal.settings.basePath + 'mnc/ajax/all-read',
      dataType: 'json',
      success: Drupal.mnc.markAllReadSuccess,
    });
  }

  Drupal.mnc.markAllUnread = function() {
    $.ajax({
      type: 'POST',
      url: Drupal.settings.basePath + 'mnc/ajax/all-unread',
      dataType: 'json',
      success: Drupal.mnc.markAllUnreadSuccess,
    });
  }

  Drupal.mnc.handleMessage = function(message) {
    var count = Drupal.mnc.getCount();
    if (Drupal.mnc.detectLocalStorage()) {
      count = count + 1;
      Drupal.mnc.setCount(count);
    } else {
      // we can access our local storage and determine wether we received this message already
      var messages = localStorage.getItem("mnc_notifications_messages");

      if (messages == null || messages == "undefined") {
        messages = [];
      } else {
        messages = jQuery.parseJSON(messages);
      }

      // if we have a new message increment our counter and save it to local storage
      if (-1 == $.inArray(message.mid, messages)) {
        messages.push(message.mid);
        count = count + 1;
        Drupal.mnc.setCount(count);
      }

      localStorage.setItem("mnc_notifications_messages", JSON.stringify(messages));
    }
  }

  // request a fresh counter from backend
  Drupal.mnc.requestUnreadCounter = function() {
    // console.log('updating');
    var data = $.ajax({
      type: 'POST',
      url: Drupal.settings.basePath + 'mnc/ajax/unread-count',
      dataType: 'json',
      async: false
    });
    try {
      json = $.parseJSON(data.responseText);
    } catch (exception) {
      json = false;
    }

    // https://drupal.org/node/2222473
    // there are multiple scenarios where the response might have failed due to
    // a logged out user, server errors or other black magic.
    // we fail silently here and return 0
    if (!json) {
      var count = 0;
      if (typeof console == "object" && typeof console.log == "function") {
        console.log("Error: mnc: failed loading the unread counter from " + Drupal.settings.basePath + "mnc/ajax/unread-count");
      }
    } else {
      var count = json.unread;
      count = parseInt(count);
    }

    // if we have localstorage save the requested count
    if (Drupal.mnc.detectLocalStorage()) {
      // unset the messages history
      localStorage.removeItem("mnc_notifications_messages");
      // store the count
      localStorage.setItem("mnc_notifications_count", count);

      if (
        typeof Drupal.settings.mnc.expire_seconds != undefined
          && Drupal.settings.mnc.expire_seconds > 1
        ) {
        var expire_time = Drupal.settings.mnc.expire_seconds;
        expire_time = expire_time * 1000;
      } else {
        // default to one minute
        var expire_time = 60000;
      }
      localStorage.setItem("mnc_notifications_cache_valid_timestamp", new Date().getTime() + expire_time);
    }
    return count;
  }

  Drupal.mnc.setCount = function(count) {
    Drupal.mnc.setDomCount(count);

    // store the updated value in localstorage if possible
    if (Drupal.mnc.detectLocalStorage()) {
      localStorage.setItem("mnc_notifications_count", count);
    }
    Drupal.settings.mnc.unread_count = count;
  }

  Drupal.mnc.getCount = function(forceRefresh) {
    forceRefresh = typeof forceRefresh !== 'undefined' ? forceRefresh : false;

    if (Drupal.mnc.detectLocalStorage()) {
      var mnc_count = localStorage.getItem("mnc_notifications_count");
      var mnc_valid_timestamp = localStorage.getItem("mnc_notifications_cache_valid_timestamp");
      if (
        mnc_count == null
          || typeof mnc_count == "undefined"
          || mnc_valid_timestamp == null
          || typeof mnc_valid_timestamp == "undefined"
          || mnc_valid_timestamp < new Date().getTime()
          || forceRefresh
        ) {
        // console.log('requesting new count');
        return Drupal.mnc.requestUnreadCounter();
      }
      mnc_count = parseInt(mnc_count);
      return mnc_count;
    } else {
      if (typeof Drupal.settings.mnc.unread_count == "undefined" || forceRefresh) {
        var count = Drupal.mnc.requestUnreadCounter();
        return count;
      }
      return Drupal.settings.mnc.unread_count;
    }
  }

  /**
   * Does not rely on Modernizr here, use with caution
   * @returns int
   */
  Drupal.mnc.getCountFromCacheSafe = function() {
    try {
      var mnc_count = localStorage.getItem("mnc_notifications_count");
      // var mnc_valid_timestamp = localStorage.getItem("mnc_notifications_cache_valid_timestamp");
      if (
        mnc_count == null
          || typeof mnc_count == "undefined"
          // we dont care about whether this counter was/ is valid, let this be handled by the next update iteration
          // || mnc_valid_timestamp == null
          // || typeof mnc_valid_timestamp == "undefined"
          // || mnc_valid_timestamp < new Date().getTime()
        ) {
        return 0;
      }
      mnc_count = parseInt(mnc_count);
      return mnc_count;
    } catch(e) {
      if (typeof Drupal.settings.mnc.unread_count == "undefined") {
        return 0;
      }
      return Drupal.settings.mnc.unread_count;
    }
  }

  Drupal.mnc.setDomCount = function(count) {
    $('.unread-messages-link .unread-messages-count').text(count);
    var $indicator = $('.mnc-unread-messages-indicator');
    if (count > 0 && $indicator.length) {
      if ($indicator.hasClass('no-unread-messages')) {
        $indicator.removeClass('no-unread-messages');
      }
      if (!$indicator.hasClass('has-unread-messages')) {
        $indicator.addClass('has-unread-messages');
      }
    } else {
      if ($indicator.hasClass('has-unread-messages')) {
        $indicator.removeClass('has-unread-messages');
      }
      if (!$indicator.hasClass('no-unread-messages')) {
        $indicator.addClass('no-unread-messages');
      }
    }
  }

  Drupal.mnc.getDomCount = function() {
    return parseInt($('.unread-messages-link .unread-messages-count').text());
  }

  Drupal.mnc.updateCountInterval = function(forceRefresh) {
    forceRefresh = typeof forceRefresh !== "undefined" ? forceRefresh : false;

    if (Drupal.mnc.detectLocalStorage()) {
      var forceRefresh = false;
    }
    var counter = Drupal.mnc.getCount(forceRefresh);
    Drupal.mnc.setCount(counter);
  }

  Drupal.mnc.detectedLocalStorage = null;
  Drupal.mnc.detectLocalStorage = function() {
    if (Drupal.mnc.detectedLocalStorage == null) {
      if (typeof Modernizr != "undefined") {
        if(Modernizr.localstorage) {
          Drupal.mnc.detectedLocalStorage = true;
        } else {
          Drupal.mnc.detectedLocalStorage = false;
        }
      } else {
        var mod = 'modernizrMNC';
        try {
          localStorage.setItem(mod, mod);
          localStorage.removeItem(mod);
          Drupal.mnc.detectedLocalStorage = true;
        } catch(e) {
          Drupal.mnc.detectedLocalStorage = false;
        }
      }
    }
    return Drupal.mnc.detectedLocalStorage;
  }

  $(function() {
    var qtip_settings = {
      show: 'click',
      hide: 'unfocus',
      content: {
        text: $('.mnc-container .mnc-inner-container')
      },
      position: {
        my: 'top center',
        at: 'bottom center',
        viewport: $(window),
        adjust: {
          method: "shift none"
        }
      },
      style: {
        classes: Drupal.settings.mnc.qtip_classes + ' qtip-view',
        // Overrides width set by CSS (but no max-width!)
        width: Drupal.settings.mnc.qtip_width
        // Overrides height set by CSS (but no max-height!)
        //height: 250
      },
      events: {
        show: function() {
          // console.log('running all the stuff');
          //$.waypoints('refresh');
          //Drupal.settings.mnc.addWayPoints = true;
          //Drupal.attachBehaviors();

          var fnMarkAllRead = function(event) {
            event.preventDefault();
            Drupal.mnc.markAllRead();
          }

          var fnMarkAllUnread = function(event) {
            event.preventDefault();
            Drupal.mnc.markAllUnread();
          }

          // Bind click events
          if(iCanUseOn) {
            $('.mnc-inner-container .markAllRead').on('click.mncAllRead', fnMarkAllRead);
            $('.mnc-inner-container .markAllUnread').on('click.mncAllUnread', fnMarkAllUnread);
          } else {
            // support for jQuery < 1.7
            $('.mnc-inner-container .markAllRead').bind('click', fnMarkAllRead);
            $('.mnc-inner-container .markAllUnread').bind('click', fnMarkAllUnread);
          }

          Drupal.behaviors.mnc.attach(null, Drupal.settings);
          if ($.waypoints != undefined) {
            $.waypoints('refresh');
          }
        },
        hide: function() {
          // Unbind click events
          if(iCanUseOn) {
            $('.mnc-inner-container .markAllRead').off('click.mncAllRead');
            $('.mnc-inner-container .markAllUnread').off('click.mncAllUnread');
          } else {
            // support for jQuery < 1.7
            $('.mnc-inner-container .markAllRead').unbind('click');
            $('.mnc-inner-container .markAllUnread').unbind('click');
          }

          $(this).qtip('destroy');
          $('.mnc-container').append(mnc_container);
          qtip_settings.content.text = $('.mnc-container .mnc-inner-container');
          Drupal.attachBehaviors();
          $('.mnc-container .unread-messages-link').qtip(qtip_settings);
        }
      }
    };
    var mnc_container = $("<div />").append($('.mnc-inner-container').clone()).html();
    // console.log(mnc_container);
    $('.mnc-container .unread-messages-link').qtip(qtip_settings);

    // initialize counter
    // var counter = Drupal.mnc.getCount(false);
    // Drupal.mnc.setCount(counter);

    // we dont need to init the counter here anymore, since we do it synchronously in mnc.tpl.php
    // Drupal.mnc.updateCountInterval(true);

    // initialize update interval
    if (Drupal.mnc.detectLocalStorage()) {
      if (Drupal.settings.mnc.refresh_interval > 0) {
        Drupal.mnc.updateIntervalId = setInterval(
          Drupal.mnc.updateCountInterval,
          Drupal.settings.mnc.refresh_interval * 1000
        );
      }
    } else {
      if (Drupal.settings.mnc.refresh_interval_poll > 0) {
        Drupal.mnc.updateIntervalId = setInterval(
          Drupal.mnc.updateCountInterval,
          Drupal.settings.mnc.refresh_interval_poll * 1000
        );
      }
    }
  });

  Drupal.behaviors.mnc = {
    attach: function (context, settings) {
      if (settings && settings.mnc) {
        // prevent page from scrolling when scrolling a div element
        // http://stackoverflow.com/questions/7600454/how-to-prevent-page-scrolling-when-scrolling-a-div-element
        $('.qtip-view ' + Drupal.settings.mnc.view_css_selector).
          bind('mousewheel DOMMouseScroll', function (e) {
            if (e.originalEvent) {
              e = e.originalEvent;
            }
            var delta = e.wheelDelta || - e.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
          });

        // update unread count
        $('.unread-messages-link .unread-messages-count').text(settings.mnc.unread_count);
        if (typeof settings.mnc.unread_count != "undefined") {
          Drupal.mnc.setCount(settings.mnc.unread_count);
        }

        // waypoint pager
        // old version, newer one replaces the complete behaviour of views_load_more
        /*
         if (settings && settings.viewsLoadMore && settings.views && settings.views.ajaxViews) {
         console.log('yes!');
         opts = {
         offset: '100%',
         };
         $.each(settings.viewsLoadMore, function(i, setting) {
         // console.log(setting);
         if (setting.view_name == Drupal.settings.mnc.view) {
         var view = '.view-id-' + setting.view_name + '.view-display-id-' + setting.view_display_id;
         var pager = '.view-id-' + setting.view_name + '.view-display-id-' + setting.view_display_id + ' .pager-next a';
         var $view = $(view);
         var $pager = $(pager);
         opts.context = view;
         //console.log(opts);
         //console.log($view);
         //console.log($pager);
         console.log('mnc');
         $pager.waypoint(function(event, direction) {
         console.log('fired');
         console.log($pager);
         $pager.click();
         $pager.waypoint('destroy');
         }, opts);
         }
         });
         }*/
      }
    }
  };

  /**
   * Attaches the AJAX behavior to Views Load More waypoint support.
   *
   * We have to override their attaching with a more context based one, because
   * we do not have weights to override their waypoint pager in our own
   * behavior.
   * http://drupal.stackexchange.com/questions/1673/how-can-i-control-the-order-of-drupal-behaviors
   */
  Drupal.behaviors.ViewsLoadMore = {
    attach: function (context, settings) {
      if (settings && settings.viewsLoadMore && settings.views && settings.views.ajaxViews) {
        opts = {
          offset: '100%'
        };
        $.each(settings.viewsLoadMore, function(i, setting) {
          var view = '.view-id-' + setting.view_name + '.view-display-id-' + setting.view_display_id;
          var pager = view + ' .pager-next a';
          opts.context = view;
          $(pager).waypoint(function(event, direction) {
            $(pager).waypoint('destroy');
            $(pager).click();
          }, opts);
        });
      }
    },
    detach: function (context, settings, trigger) {
      if (settings && Drupal.settings.viewsLoadMore && settings.views && settings.views.ajaxViews) {
        $.each(settings.viewsLoadMore, function(i, setting) {
          var view = '.view-id-' + setting.view_name + '.view-display-id-' + setting.view_display_id;
          var pager = view + ' .pager-next a';
          $(pager, context).waypoint('destroy');
        });
      }
    }
  };
})(jQuery);
