<div class="login-box-body">
    <div class="container">
        <div class="row">
            <img class="img-logo-login" src="" alt="">
            <h2 class="login-box-msg">WELLCOME TO VKTECH SCHOOL</h2>
            <?php if ($messages): ?>
            <div id="messages">
                <div class="section clearfix">
                    <?php print $messages; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php
                $form = drupal_get_form('user_login');
                $form['name']['#attributes']['placeholder']=$form['name']['#title'];
                unset($form['name']['#title']);
                $form['pass']['#attributes']['placeholder']=$form['pass']['#title'];
                unset($form['pass']['#title']);
                print drupal_render($form);
            ?>
                <div class="item-login">
                    <a href="<?php print $$base_path; ?>/user/password">
                    <?php print t('Quên mật khẩu?'); ?>
                </div>
        </div>
    </div>
</div>