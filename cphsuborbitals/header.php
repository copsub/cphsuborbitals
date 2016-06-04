<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]--><head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="google" value="notranslate">
    <meta name="skype_toolbar" content="skype_toolbar_parser_compatible" />
    <meta name="google-site-verification" content="7M6XNuooy5c9z7irA_8jUODaMhLgF5E0kuY5g4dVZWc" />
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
<span id="preload-02"></span>
<span id="preload-03"></span>
<span id="preload-04"></span>
<?php 

$server_name = $_SERVER['SERVER_NAME'];
$path = ( $server_name === 'localhost' ? 'http://localhost:88/websites/support-us' : '/support-us/#support' );

$themepath = ( $server_name === 'sb1.local' ? 'http://sb1.local/wp-content/themes/cphsuborbitals' : CHILD_THEME_URI );

?>  


<div id="donatebar" style="background-color:#FF4F00;">
	<div style="margin: 0 auto; width: 860px;padding-left:655px;padding-top:10px;">
      	<span style="margin-right:5px;"><a href="<?php $server_name ?>/support-us/" onclick="_gaq.push(['_trackEvent','Support','Click','Donate on donatebar']);"><img src="<?php echo $themepath?>/img/donate_icon.png"></a></span>
      	<span><a href="#TB_inline?width=400&height=200&inlineId=CAWC_social_share_popup" class="thickbox"><img src="<?php echo $themepath?>/img/share_icon.png" alt="Share Social" title="Share this"/></a></span>          
    </div>
</div>

<div class="header-top">
    <div style="margin: 0 auto; width: 953px;padding-right:60px;padding-top:26px;">
    <table style="width:100%">
    <tr>
    <td style="width:315px;"><a href="<?php $server_name ?>/"><img src="<?php echo $themepath?>/img/cslogo.png"></a></td>
    <td style="font: 14px helvetica, sans-serif; font-weight: normal; color: #FFFFFF;padding-top:18px;padding-right:10px;">


     <?php 
	 
	 $is_member = copsub_get_user_role( 'subscriber' ); 
	 $is_admin  = copsub_get_user_role( 'administrator' );
     
	 if ( ! is_user_logged_in() ) { ?>
	  	 
     <?php 
	 } ?>
	 
     <?php 

	 if ( is_user_logged_in() ) { ?>
    <a class="user-profile" style="" href="<?php echo (site_url().'/user-page'); ?>" title="Profile">Profile</a>
    <a class="user-logout" style="" href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>

     <?php 
	 } ?>



    </td>
    <td style="width:52px;">
    <a href="https://www.youtube.com/user/CphSuborbitals" target="_blank"><div class="youtube-button"></div></a>
    </td>
    <td style="width:52px;">
    <a href="https://www.facebook.com/CopenhagenSuborbitals" target="_blank"><div class="facebook-button"></div></a>
    </td>
    <td style="width:52px;">
    <a href="https://twitter.com/copsub" target="_blank"><div class="twitter-button"></div></a>
    </td>
    </tr>
    </table>

      	      
    </div>
	 
</div>
  
  
<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<?php endif; ?>  
  <?php //echo $image[0]; ?>
  
<div id="CAWC_social_share_popup" class="CAWC_social_share_popup" style="display:none;">
	 <h1>Share this...</h1>
	 
     <center>
<div class="share42init" data-url="<?php the_permalink() ?>" data-title="<?php the_title()?>"></div>

	 </center>
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
     
