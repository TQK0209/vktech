<div class="wrapper">
  

  <!-- Content Wrapper. Contains page content -->
  <div class="login-box">
  <div class="login-logo">
    <a href="<?php print $front_page; ?>"><?php print $site_name; ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php print t('Let us help you reset password'); ?></p>
	<?php
	$form = drupal_get_form('user_pass');
	print drupal_render($form);
	?>
 
    <a href="<?php print $front_page; ?>/user/login" class="text-center register-link">Login</a>

  </div>
  <!-- /.login-box-body -->
</div>
     <!-- /.content-wrapper -->

 
</div>
 <!-- ./wrapper -->
