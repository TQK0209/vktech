<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <?php if ($logo): ?>
	    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
	  <?php endif; ?>

    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

        <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu custom-section">
        <?php print render($page['header_right']); ?>
      </div>
    </nav>

  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php print render($page['sidebar_first']); ?>
	  </section>
	<!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 100px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if ($breadcrumb): ?>
        <ol class="breadcrumb"><li><?php print $breadcrumb; ?></li></ol>
      <?php endif; ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php if ($messages): ?>
        <div id="messages">
          <div class="section clearfix">
            <?php print $messages; ?>
          </div>
        </div>
      <?php endif; ?>

      <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?php print $front_page; ?>">return to dashboard</a>.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>

    </section>

  </div>
     <!-- /.content-wrapper -->

  <footer class="main-footer">
     <div class="pull-right hidden-xs">
       <b>Powered by:</b> <a href="http://reboundmedia.com.ng/eaize">EAZE</a>
     </div>
     <strong>Copyright &copy; <?php print date('Y'); ?> <?php print $site_name; ?>.</strong> All rights
     reserved.
  </footer>


   <aside class="control-sidebar control-sidebar-dark">
     <?php print render($page['control_sidebar']); ?>
   </aside>
   <!-- /.control-sidebar -->
   <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
</div>
 <!-- ./wrapper -->
