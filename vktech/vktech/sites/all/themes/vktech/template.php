<?php

/**
 * 
 */


function vktech_preprocess_html(array &$variables) {
    if (drupal_is_front_page()) {
        drupal_add_css(drupal_get_path('theme', 'vktech') . '/css/front.css');
        drupal_add_js(drupal_get_path('theme', 'vktech') . '/js/front.js');
    }
}