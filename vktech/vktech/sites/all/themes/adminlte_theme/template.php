<?php

/**
 * @file
 * Template file.
 */

function adminlte_theme_preprocess_html(array &$variables) {
	$theme_color = theme_get_setting('adminlte_theme_color','adminlte_theme');
	drupal_add_css(drupal_get_path('theme', 'adminlte_theme') . '/css/skins/' . $theme_color . '.css', array('group' => CSS_THEME, 'weight' => 120));
   $variables['body_attributes_array']['class'][] = 'hold-transition ';
   $variables['body_attributes_array']['class'][] = $theme_color .' sidebar-mini';
	 
	 if($_GET['q'] == 'user/login'){
		unset($variables['body_attributes_array']['class']);
		$variables['body_attributes_array']['class'][] = 'hold-transition login-page';  
   }
   if($_GET['q'] == 'user/register'){
		unset($variables['body_attributes_array']['class']);
		$variables['body_attributes_array']['class'][] = 'hold-transition register-page';  
   }
   if($_GET['q'] == 'user/password'){
		unset($variables['body_attributes_array']['class']);
		$variables['body_attributes_array']['class'][] = 'hold-transition register-page';  
   }

}

/**
 * Implements hook_menu_tree().
 */
function adminlte_theme_menu_tree(array &$variables) {
  return '<ul class="sidebar-menu" data-widget="tree">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_menu_link().
 */
function adminlte_theme_menu_link(array $variables) {
	$output = '';
	$element = $variables['element'];
	$sub_menu = '';
	if(function_exists('_bootstrap_get_classes')){
		if (in_array('expanded', _bootstrap_get_classes($element))){
			$element['#attributes']['class'][] = "treeview";
		}
	
		$options = !empty($element['#localized_options']) ? $element['#localized_options'] : array();

		// Check plain title if "html" is not set, otherwise, filter for XSS attacks.
		$title = empty($options['html']) ? check_plain($element['#title']) : filter_xss_admin($element['#title']);
		
		$options['html'] = TRUE;
		$href = $element['#href'];
		$attributes = !empty($element['#attributes']) ? $element['#attributes'] : array();
		// if link class is active, make li class as active too
		if(strpos($output,"active")>0){
			$element['#attributes']['class'][] = "menu-open";
		}	
		
		if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
			// Add our own wrapper.
			unset($element['#below']['#theme_wrappers']);
			$sub_menu = '<ul class="treeview-menu">' . drupal_render($element['#below']) . '</ul>';

			// Generate as standard dropdown.
			if (in_array('treeview', _bootstrap_get_classes($element))){
				$title .= ' <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
			}
		}
		
		return '<li' . drupal_attributes($element['#attributes']) . '>' .  l($title, $href, $options) . $sub_menu . "</li>\n";
	} 
}

/**
 * Implements hook_preprocess_page().
 */
function adminlte_theme_preprocess_page(&$vars) {
  $header = drupal_get_http_header('status'); 
  if ($header == '404 Not Found') {     
    $vars['theme_hook_suggestions'][] = 'page__404';
  }
}
