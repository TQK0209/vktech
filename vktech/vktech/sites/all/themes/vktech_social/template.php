<?php

/**
 * @file
 * Bootstrap sub-theme.
 *
 * Place your custom PHP code in this file.
 */
function vktech_social_preprocess_html(array &$variables) {
    /* if (drupal_is_front_page()) {
        drupal_add_css(drupal_get_path('theme', 'vktech') . '/css/front.css');
        drupal_add_js(drupal_get_path('theme', 'vktech') . '/js/front.js');
    } */

    //dsm($variables);
}
function vktech_social_form_alter(&$form, &$form_state, $form_id) {
    if($form_id=='social_post_node_form'){
        $form['field_social_images']['#suffix'] = '<div data_id="edit-field-social-images" class="toggle-field"><i class=" fas fa-image"></i>Images</div>';
        $form['field_video']['#suffix'] = '<div data_id="edit-field-video" class="toggle-field"><i class="fas fa-film-alt"></i>Videos</div>';
        
        $form['field_file']['#suffix'] = '<div data_id="edit-field-file" class="toggle-field"><i class="fas fa-folder-open"></i>Files</div><div class="toggle-close-file"><i class="fas fa-trash-alt"></i>Hủy</div>';
        drupal_add_js(drupal_get_path('theme', 'vktech_social') . '/js/social_post_form.js');
    }
}