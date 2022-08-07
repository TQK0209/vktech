Drupal.Nodejs.callbacks.mnc_nodejs_counter_add = {
  callback: function (message) {
    if (message.callback == 'mnc_nodejs_counter_add') {
      var count = Drupal.mnc.getCount();
      count = count + 1;
      if (count >= 0) {
        Drupal.mnc.setCount(count);
      }
    }
  }
};
Drupal.Nodejs.callbacks.mnc_nodejs_counter_sub = {
  callback: function (message) {
    if (message.callback == 'mnc_nodejs_counter_sub') {
      var count = Drupal.mnc.getCount();
      count = count - 1;
      if (count >= 0) {
        Drupal.mnc.setCount(count);
      }
    }
  }
};
