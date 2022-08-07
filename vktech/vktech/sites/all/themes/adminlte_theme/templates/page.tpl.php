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
      <div class="navbar-custom-menu ">
        <div class="profile-container profile-block">
        <?php global $user;$profile= user_load($user->uid);?>
        <?php 
        if($logged_in){
           global $base_path;
          echo '<a class="profile-link" href="'.$base_path.'users/'.$profile->name.'">';
          echo '<div class="avatar profile">';
          if(isset($profile->picture->uri)){
            print theme('image_style', array('style_name' => 'thumbnail','path' =>$profile->picture->uri));
          }
          else{
            echo '<img  class="img-responsive" src="'.$base_path.'sites/all/themes/adminlte_theme/img/user.png" alt="">';
          }
          
          echo '</div><div class="profile display-name">';
          if(isset($profile->field_display_name['und'][0]['value'])){
            print($profile->field_display_name['und'][0]['value']);
          }
          else{
            print($profile->name);
          }
          echo '</div></a>';       
        }
         ?>
         
         <div class="profile-menu collapse">
           <?php  $menu = menu_navigation_links('menu-profile-menu');
          print theme('links__menu_profile_menu', array('links' => $menu));
           ?>
         </div>
        <?php print render($page['header_right']); ?>
      </div>
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
    <div class="top-content custom-section">
      <div class="breadcrumb-block">
        <?php if ($breadcrumb): ?>
        <ol class="breadcrumb"><li><?php print $breadcrumb; ?></li></ol>
        <?php else: ?>
          <ol class="breadcrumb"><li><a class="menu-icon icon-dashboard" href="">Dashboard</a></li></ol>
      <?php endif; ?>
      </div>
      <div class="top-content-region">
        
        <?php print render($page['content_top']); ?>
      </div>
      </div>
    <section class="content-header">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
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
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <?php print render($page['content_top_first']); ?>
        </div>
        <div class="col-lg-3 col-xs-6">
          <?php print render($page['content_top_second']); ?>
        </div>
        <div class="col-lg-3 col-xs-6">
          <?php print render($page['content_top_third']); ?>
        </div>
        <div class="col-lg-3 col-xs-6">
          <?php print render($page['content_top_fourth']); ?>
        </div>
      </div>

      <!--main page cont -->
      <div class="row">
       <?php if($page['sidebar_second']) { $primary_col = 7; } else { $primary_col = 12; } ?>
         <section class="col-lg-<?php print $primary_col; ?>">
		 <div class=""><div class="box-body">
           <?php if ($tabs): ?>
             <div class="tabs">
               <?php print render($tabs); ?>
             </div>
           <?php endif; ?>
           <?php print render($page['content']); ?>
		  </div></div>
        </section>
       <!-- /.col -->
       <!--sidebar_second -->
       <?php if($page['sidebar_second']) :?>
	   <section class="col-lg-5">
         <div class="box box-success"><div class="box-body">
		 <?php print render($page['sidebar_second']); ?>
		 </div></div>
       </section>
	   <?php endif; ?>

      </div>

    </section>
	
	<div class="row">
       <?php if($page['content_left'] || $page['content_right']): ?>
	   <div class="col-md-6">
	     <?php if($page['content_left']): ?>
		   <div class="box box-widget">
		    <div class="box box-body">
			   <?php print render($page['content_left']); ?>
			</div>
           </div>
		 <?php endif; ?>
	   </div>
       <div class="col-md-6">
	     <?php if($page['content_right']): ?>
		   <div class="box box-widget">
		    <div class="box box-body">
			   <?php print render($page['content_right']); ?>
			</div>
           </div>
		 <?php endif; ?>
	   </div>
	   <?php endif; ?>
    </div>

  </div>
     <!-- /.content-wrapper -->

  <footer class="main-footer">
     
     <strong>Copyright 2020 &copy; | Công ty TNHH Văn Minh Số - DiCi </strong>
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
