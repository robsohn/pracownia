<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title>
      <?php
        /*
         * Print the <title> tag based on what is being viewed.
         */
        global $page, $paged;

        wp_title('|', true, 'right');

        // Add the blog name.
        bloginfo('name');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
          echo " | $site_description";
      ?>
    </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Robert Raszczynski">

    <!-- Le styles -->
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link rel="stylesheet"  href="<?php bloginfo('stylesheet_url'); ?>" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
<!-- TODO create favicon -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
    <?php wp_head(); ?>
  </head>

  <body data-spy="scroll">

    <div class="navbar">
      <div class="navbar-inner">
        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
  <!-- TODO dodac title do linku -->
            <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Robert Raszczynski - Pracownia Portretu - Portfolio fotograficzne">Robert Raszczynski - Pracownia Portretu - Portfolio fotograficzne</a>

            <div class="nav-collapse">
              <ul class="nav">
                <li class="active"><a href="<?php echo esc_url( home_url( '/' ) ); ?>#portfolio">Portfolio</a></li>
                <li><a href="<?php echo esc_url(home_url('/')); ?>#sesja-portretowa">Sesja Portertowa</a></li>
                <li><a href="<?php echo esc_url(home_url('/')); ?>#blog">Blog</a></li>
                <li><a href="<?php echo esc_url(home_url('/')); ?>#robert">Robert</a></li>
                <li><a href="<?php echo esc_url(home_url('/')); ?>#kontakt">Kontakt</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>

        </div>
      </div>
    </div>

    <div class="container content">