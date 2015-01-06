<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]--><head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="google" value="notranslate">
    <meta name="skype_toolbar" content="skype_toolbar_parser_compatible" />
    
    <?php if ( unit_ipad ) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Turn off telephone number detection. -->
    <meta name = "format-detection" content = "telephone=no">    
    <?php endif; ?>
    
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo CHILD_THEME_URI; ?>/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php 

$server_name = $_SERVER['SERVER_NAME'];
$path = ( $server_name === 'localhost' ? 'http://localhost:88/websites/support-us' : '/support-us/#support' );

?>  

       <div id="sticky">
          <div class="support"><a href="<?php echo $path ?>"></a></div>
       </div>

  <?php //if ( unit_ipad || unit_desktop ) : ?>

  <div class="header-top">
      
     <?php 
	 
	 $is_member = copsub_get_user_role( 'subscriber' ); 
	 $is_admin  = copsub_get_user_role( 'administrator' );
     
	 if ( ! is_user_logged_in() ) { ?>
         <div class="user-register"><a href="<?php echo (site_url().'/register'); ?>" title="Register">Register</a></div>
         <div class="user-login"><a href="<?php echo (site_url().'/login'); ?>" title="Member login">Member login</a></div>
     <?php 
	 } ?>
	 
     <?php 

	 if ( is_user_logged_in() ) { ?>
         <div class="user-profile"><a href="<?php echo (site_url().'/user-page'); ?>" title="Profile">Profile</a></div>
         <div class="user-logout"><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a></div>
     <?php 
	 } ?>
	 
     <div class="cphsuborb-logo">
           <a href="/"></a>
     </div>
  </div>
  
  <div class="header-menu clr">
  
        <header class="clr">
            <nav>
               <?php cphsuborbitals_menu(); ?>    
            </nav>
        </header>
  </div>

  <div class="main-container clr">
  
      <div class="main-content wrapper clr">
     
