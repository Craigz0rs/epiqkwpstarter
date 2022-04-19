<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>
<!DOCTYPE html>
<html class="nojs" lang="en_US">
<head>

<script>document.documentElement.className = "js"; </script>

<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#1F3050">

<!-- <script src="https://www.google.com/recaptcha/api.js?render=_SITE-KEY-HERE_" async defer></script> -->
<?php wp_head(); ?>

</head>
<body <?php print body_class(); ?> id="body">
<a href="#!/site-main" id="skip-to-content" class="screen-reader-text">Skip to main content</a>
<header class="header" id="site-header">
  <div class="header__wrap content-wrap">
    <a class="header__branding" href="<?php echo get_home_url(); ?>">
      <img class="header__logo--white" src="<?php echo get_template_directory_uri(); ?>/assets/images/epiqk_logo_black.svg"/>
    </a>
    <nav class="nav nav__main" aria-label="Main Navigation">
      <button class="button nav__button button--nav" id="toggle-main-nav" aria-expanded="false">
        <div class="nav__icon-wrap">
          <span class="nav__icon"></span>
        </div>
      </button>
      <div class="nav__main-wrap">
        <?php
          wp_nav_menu(array(
            'menu'  => 'primary',
          ));
        ?>

      </div>

    </nav>
  </div>

</header>


