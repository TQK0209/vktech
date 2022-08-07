<?php

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
 
function adminlte_theme_form_system_theme_settings_alter(&$form, &$form_state) {
   
    $form['adminlte_theme_color'] = array(
        '#type' => 'select',
        '#title' => t('Colors'),
        '#description'   => t('From the drop-down menu, select the color scheme you prefer.'),
        '#default_value' => theme_get_setting('adminlte_theme_color','adminlte_theme'),
        '#options' => array(
            'skin-black' => t('Dark Black'),
            'skin-blue' => t('Dark Blue'),
            'skin-green' => t('Dark Green'),
            'skin-purple' => t('Dark Purple'),
            'skin-red' => t('Dark Red'),
            'skin-yellow' => t('Dark Yellow'),
            'skin-black-light' => t('Light Black'),
            'skin-blue-light' => t('Light Blue Dark'),
            'skin-green-light' => t('Light Green'),
            'skin-purple-light' => t('Light Purple'),
            'skin-red-light' => t('Light Red'),
            'skin-yellow-light' => t('Light Yellow'),
        ),
    );
	$form['adminlte_theme_views_fieldset'] = array(
        '#type' => 'checkbox',
        '#title' => t('Put Views Exposed Filters in a collapsed fieldset'),
        '#description'   => t('Uncheck this option to remove the views exposed filter in a collapsed fieldset'),
        '#default_value' => theme_get_setting('adminlte_theme_views_fieldset')
    );
}