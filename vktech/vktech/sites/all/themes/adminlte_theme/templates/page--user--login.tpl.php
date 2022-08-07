<div class="wrapper">
  

  <!-- Content Wrapper. Contains page content -->
  <div class="login-box">
  <div class="login-logo">
    <h2>Phần mềm quản lí Dự án</h2>
    <h3>Dici Project</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Đăng nhập để sử dụng phần mềm</p>
    <?php if ($messages): ?>
      <div id="messages">
        <div class="section clearfix">
          <?php print $messages; ?>
        </div>
      </div>
    <?php endif; ?>

    <?php
      $form = drupal_get_form('user_login');
      print drupal_render($form);
    ?>
    
    <a href="<?php print $front_page; ?>/user/password"><?php print t('Quên mật khẩu?'); ?></a><br>
    <a href="<?php print $front_page; ?>/user/register" class="text-center register-link">Register</a>

  </div>
  <!-- /.login-box-body -->
</div>
     <!-- /.content-wrapper -->

 
</div>
 <!-- ./wrapper -->
