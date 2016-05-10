<?php
/*
Template Name: Frontpage Sections Template
*/
?>

<?php get_header('front'); 

  $server_name = $_SERVER['SERVER_NAME'];

  global $post;

  $title    =  get_field( '_frontpage_template_1_title', $post->ID );
  $text     =  get_field( '_frontpage_template_1_text',  $post->ID );
  $video_id =  esc_attr( strip_tags( trim( get_field( '_frontpage_template_1_video', $post->ID ) ) ) );
  $themepath = ( $server_name === 'sb1.local' ? 'http://sb1.local/wp-content/themes/cphsuborbitals' : CHILD_THEME_URI );
  //$url_for_steaming_link = get_field( 'url_for_steaming_link',  $post->ID );
  $url_for_steaming_link = get_youtube_streaming_url_from_text_file();
  $url_for_post_link = get_field( 'url_for_post_link',  $post->ID );
  $event_mode_active = get_field( 'event_mode_active',  $post->ID );
  $url_link_ready = get_field( 'url_link_ready',  $post->ID );
  $event_button_text = get_field( 'event_button_text',  $post->ID );
  
  //var from settings page
  $launch_time_date = get_field( 'launch_time_date', 'option' );
  $launch_date = date('F jS', strtotime($launch_time_date));
  $launch_message = get_field( 'front_launch_message', 'option' );

  $time_hiding_countdown_frontpage = get_field( 'time_hiding_countdown_frontpage',  'option' );
  $show_countdown_on_frontpage = get_field( 'show_countdown_on_frontpage',  'option' );
  
  //Sections
  $front_section_1_active = get_field( 'front_section_1_active',  'option' );
  $background_image_front_section_1 = get_field( 'background_image_front_section_1',  'option' );
  $front_section_1_headline_l1 = get_field( 'front_section_1_headline_l1',  'option' );
  $front_section_1_link_button = get_field( 'front_section_1_link_button',  'option' );

  $front_section_2_active = get_field( 'front_section_2_active',  'option' );
  $front_section_3_active = get_field( 'front_section_3_active',  'option' );
  $front_section_4_active = get_field( 'front_section_4_active',  'option' );
  $front_section_5_active = get_field( 'front_section_5_active',  'option' );

  //Sections height
  if ($front_section_1_active) {
  	$section_1_height = $background_image_front_section_1[height];
  } else {
  	$section_1_height = 0;
  } 
    if ($front_section_2_active) {
  	$section_2_height = 1306;
  } else {
  	$section_2_height = 0;
  } 
    if ($front_section_3_active) {
  	$section_3_height = 500;
  } else {
  	$section_3_height = 0;
  } 
    if ($front_section_4_active) {
  	$section_4_height = 3850;
  } else {
  	$section_4_height = 0;
  } 
    if ($front_section_5_active) {
  	$section_5_height = 599;
  } else {
  	$section_5_height = 0;
  } 
  $section_6_height = 200;
  
  //Section 1 top position
  $section_1_top_position = 0;

  //Section 2 top position
  $section_2_top_position = $section_1_height;

  //Section 3 top position
  $section_3_top_position = $section_1_height+$section_2_height;
  
  //Section 4 top position
  $section_4_top_position = $section_1_height+$section_2_height+$section_3_height;
  
  //Section 5 top position
  $section_5_top_position = $section_1_height+$section_2_height+$section_3_height+$section_4_height;

  //Section 6 top position
  $section_6_top_position = $section_1_height+$section_2_height+$section_3_height+$section_4_height+$section_5_height;

  

?>

<?php //----------- Launch mode section start ----------------------------------------------------------------------- ?>

<?php //Launch mode background 
if ($front_section_1_active) {


?>
<div style="position:absolute; top:0px; left: 0px; height: <?php echo $background_image_front_section_1[height] ?>px; width:100%; margin-left: auto; margin-right: auto; background-color: #9a9a9a; background-image:url('<?php echo $background_image_front_section_1[url] ?>'); background-position: center top;background-repeat:no-repeat;">

	<?php //Countdown section ?>
	<div style="position: relative; width:100%; margin-top: 60px;">
		<div style="text-align: right; padding-top: 0px; padding-bottom: 0px; padding-right: 50px; padding-left: 570px; margin: 0 auto; width: 1034px; font: 22px helvetica, sans-serif; font-weight: normal; color: #FFFFFF;">
		<?php 
		switch ($show_countdown_on_frontpage) {
			case "hidden":
				echo '<div class="front_launch_countdown"></div>';
				break;
			case "message":
				echo '<div class="front_launch_countdown">';
				echo '<div class="front_launch_message">'.$launch_message.' '.$launch_date.'</div>';
				echo '</div>';
				break;
			case "countdown":
				if (strtotime('now') <= $time_hiding_countdown_frontpage) {
				echo '<div class="front_launch_countdown">';
				echo do_shortcode( '[ujicountdown id="NextTest" expire="'.$launch_time_date.'" hide="true" url="" subscr="Nexø I Launch" recurring="" rectype="second" repeats=""]' ); 
				echo '</div>';
				} else {
				echo '<div class="front_launch_countdown">';
				echo '<div class="front_launch_message">'.$launch_message.'</div>';
				echo '</div>';				
				}
				break;
		}
		?>
		
		
		<?php if($show_countdown_on_frontpage && ($time_hiding_countdown_frontpage >= strtotime(now))) { ?>
		<?php } else {?>
		
		<?php } ?>
		
		
		</div>
	</div>

	<?php //Mission has started ?>
	<div style="position: relative; width:100%; margin-top: 5px;">
		<div style="text-align: right; padding-top: 0px; padding-bottom: 0px; padding-right: 34px; padding-left: 400px; margin: 0 auto; width: 1000px; font: 52px helvetica, sans-serif; font-weight: bold; color: #FFFFFF;">
		<div class="front_text_launch">
		<?php echo $front_section_1_headline_l1;

		?>
		<br>
		</div>
		</div>
	</div>
	
	<div style="position: relative; width:100%; margin-top: 25px;">
		<div style="text-align: right; padding-top: 0px; padding-bottom: 0px; padding-right: 32px; padding-left: 850px; margin: 0 auto; width: 1000px; font: 22px helvetica, sans-serif; font-weight: normal; color: #FFFFFF;">
		<div class="front_mission_patch" style="background-image:url('<?php echo $themepath?>/img/nexoepatch.png'); width:119px; height:98px;">
		</div>
		</div>
	</div>

	<div style="position: relative; width:100%; margin-top: 55px;">
		<div style="text-align: right; padding-top: 0px; padding-bottom: 0px; padding-right: 32px; padding-left: 660px; margin: 0 auto; width: 1000px; font: 22px helvetica, sans-serif; font-weight: normal; color: #FFFFFF;">
		<a style="text-decoration: none;"  href="<?php echo $front_section_1_link_button ?>" title="" onclick="_gaq.push(['_trackEvent','Media','Click','Watch Us on FP']);">
		<div class="gotomissionsquare">
		Go to the mission page
		</div>
		</a>
		</div>
	</div>
</div>

<?php  } ?>


<?php //----------- Launch mode section end ----------------------------------------------------------------------- ?>


<?php //Manned top section
if ($front_section_2_active) {
 ?>
<div style="position:absolute; top:<?php echo $section_2_top_position?>px; left: 0px; height: <?php echo $section_2_height?>px; width:100%; margin-left: auto; margin-right: auto; background-color: #9a9a9a; background-image:url('<?php echo $themepath?>/img/front-top-bck.jpg'); background-position: center top;background-repeat:no-repeat;">

	<div style="position: relative; width:100%; margin-top: 50px;">
		<div style="padding-right: 0px; margin: 0 auto; width: 970px;">
		<table style="width:100%">
		<tr>
		<td style="width: 510px;font: 70px helvetica, sans-serif; font-weight: bold; color: #FFFFFF;line-height: 78px;">
		The world’s only amateur space program
		</td>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td style="width: 500px; padding-top:30px; font: 22px helvetica, sans-serif; font-weight: normal; color: #FFFFFF;">
		<div>We’re 50 geeks building and flying our own rockets. </div>
		<div style="padding-top:10px;">
		One of us will fly into space.	
		</div>
		</td>
		<td>&nbsp;</td>
		</tr>
		</table>
		</div>
	</div>
	<div style="position: relative; width:100%; margin-top: 44px;">
		<?php if($event_mode_active) {?>
		<div style="padding-right: 60px; margin: 0 auto; width: 960px;">
		<?php } else {?>
		<div style="padding-right: 360px; margin: 0 auto; width: 960px;">
		<?php }?>
		<table style="width:100%">
		<tr>
		<td style="width: 300px;padding-left:0px;">
		<a style="text-decoration: none;" href="<?php $server_name ?>/support-us/" onclick="_gaq.push(['_trackEvent','Support','Click','Big donate button FP']);">
		<div class="donatesquare arrowcontainer" style="background-image:url('<?php echo $themepath?>/img/donatesquare.png'); background-position: right bottom;background-repeat:no-repeat;">
		It’s 100 % nonprofit and crowdfunded. Please donate here.
		<div class="arrow"></div>
		</div>
		</a>
		</td>
		<?php if($indiegogo_mode_active) {?>
		<td style="width: 300px;padding-left:15px;">
		<a style="text-decoration: none;" href="http://igg.me/at/copsub" onclick="_gaq.push(['_trackEvent','Support','Click','Big Support Nexoe button FP']);">
		<div class="indiesquare arrowcontainer" style="background-image:url('<?php echo $themepath?>/img/indifund.png'); background-position: right bottom;background-repeat:no-repeat;">
		Fund the launch of our Nexø I rocket.<br><br> Join the campaign by clicking here.
		<div class="arrow"></div>
		</div>
		</a>
		</td>
		<?php  } ?>
		<?php if($event_mode_active) {?>
		<?php if($url_link_ready) {?>
		<td style="width: 300px;padding-left:15px;">
		<a style="text-decoration: none;" href="<?php echo $url_for_post_link ?>"  onclick="_gaq.push(['_trackEvent','Events','Click','Big event button FP']);">
		<div  class="eventsquaretop arrowcontainer">
		<?php echo $event_button_text ?>
		<div class="arrow"></div>
		</div>
		</a>
		<a style="text-decoration: none;" href="<?php echo $url_for_steaming_link ?>"  target="_blank"   onclick="_gaq.push(['_trackEvent','Events','Click','Big YT button FP']);">
		<div  class="eventsquarebottom arrowcontainer" style="background-image:url('<?php echo $themepath?>/img/testsquare.png'); background-position: center bottom;background-repeat:no-repeat;">
		Live feed - Click here.
		</div>
		</a>
		</td>
		<?php } else {?>
		<td style="width: 300px;padding-left:15px;">
		<a style="text-decoration: none;" href="<?php echo $url_for_post_link ?>"  onclick="_gaq.push(['_trackEvent','Events','Click','Big event button FP']);">
		<div  class="eventsquaretop arrowcontainer">
		<?php echo $event_button_text ?>
		<div class="arrow"></div>
		</div>
		</a>
		<div  class="eventsquarebottom arrowcontainer" style="">
		Videolink will be made available here as soon as possible.
		</div>
		</td>
		<?php }?>
		<?php } else {?>
		<?php }?>
		<?php //temp download section ?>
		<td style="width: 300px;padding-left:0px;">
		<a style="text-decoration: none;" href="<?php $server_name ?>/ressources/" onclick="_gaq.push(['_trackEvent','Support','Click','Big download button FP']);">
		<div class="donatesquare arrowcontainer" style="background-image:url('<?php echo $themepath?>/img/square_download.png'); background-position: right bottom;background-repeat:no-repeat;">
		Download posters, wallpapers and more here.
		<div class="arrow"></div>
		</div>
		</a>
		</td>

			
			
		<td style="width: 30px;">&nbsp;</td>
		</tr>
		</table>
		</div>
	</div>
	<div style="position: relative; width:100%; margin-top: 70px;">
		<div style="text-align: right; padding-top: 0px; padding-bottom: 0px; padding-right: 32px; padding-left: 400px; margin: 0 auto; width: 1000px; font: 70px helvetica, sans-serif; font-weight: bold; color: #FFFFFF;">
		<div style=" line-height: 75px;">Aiming high:</div>
		<div style="padding-top:15px; line-height: 75px;">
		The manned Spica mission
		</div>
		</div>
	</div>

	<div style="position: relative; width:100%; margin-top: 30px;">
		<div style="text-align: right; padding-top: 0px; padding-bottom: 0px; padding-right: 32px; padding-left: 460px; margin: 0 auto; width: 1000px; font: 22px helvetica, sans-serif; font-weight: normal; color: #FFFFFF;">
		<div style="line-height: 35px;">
		Every step we take is leading to flying a person into space on what will be our biggest rocket: Spica
		</div>
		</div>
	</div>

	<div style="position: relative; width:100%; margin-top: 30px;">
		<div style="text-align: right; padding-top: 0px; padding-bottom: 0px; padding-right: 32px; padding-left: 679px; margin: 0 auto; width: 1000px; font: 22px helvetica, sans-serif; font-weight: normal; color: #FFFFFF;">
		<a style="text-decoration: none;" rel="wp-video-lightbox" href="https://www.youtube.com/watch?v=1i3HDv2s7io&amp;width=640&amp;height=640" title="" onclick="_gaq.push(['_trackEvent','Media','Click','Watch Us on FP']);">
		<div class="introvideosquare">
		See our intro video
		</div>
		</a>
		</div>	
	</div>
</div>


<?php } ?>




<?php //----------- Widget section ----------------------------------------------------------------------- ?>
<?php

if ($front_section_3_active) {

// News section

/*
-------------------------
[ @-> gets latest news ]
-------------------------
*/

   $query =  new WP_Query( array(
      'no_found_rows'           => true, // counts posts, remove if pagination required
      'update_pos t_meta_cache' => false,  // grabs post meta, remove if post meta required
      'update_post_term_cache'  => false, // grabs terms, remove if terms required (category, tag...)
      'post_type'               => array( 'post' ),
      'posts_per_page'          => 3,
      'category_name'           => 'news',
	  'order'                   => 'date'
   ) );

/*   
-------------------------
[ @-> gets latest blog ]
-------------------------
*/

   $query_blog =  new WP_Query( array(
      'no_found_rows'           => true, // counts posts, remove if pagination required
      'update_pos t_meta_cache' => false,  // grabs post meta, remove if post meta required
      'update_post_term_cache'  => false, // grabs terms, remove if terms required (category, tag...)
      'post_type'               => array( 'post' ),
      'posts_per_page'          => 6,
      'category_name'           => 'csblog',
	  'order'                   => 'date'
   ) );
   
   
?>

<div style="position:absolute; top:<?php echo $section_3_top_position?>px; left: 0px; height: <?php echo $section_3_height?>px; width:100%; margin-left: auto; margin-right: auto; background-color: #9a9a9a; background-image:url('<?php echo $themepath?>/img/whitebck.jpg'); background-position: center top;background-repeat:repeat-y;">
   <div class="frontpage-content clr">
   
   
   

   
   
          <?php // lastest news col ?>
       <div class="latest_news">
          <h3 class="clr">Latest blog posts</h3>
            <ul class="clr">
            
              <?php if ( $query_blog->have_posts() ) : $query_blog->have_posts();
    
                  while ( $query_blog->have_posts() ) :	$query_blog->the_post(); ?>
				    <li>
                    <?php
                      printf( '<span class="date">%s</span>', get_the_date( 'd.m.Y' ) );
                      printf( '<h2><a href="%s">%s</a></h2>', get_permalink(), get_the_title() );
					 // printf( '<a href="%s">%s</a>', get_permalink(), wp_trim_words( strip_tags( get_the_content( '', TRUE ) ), 0 ) );
					 ?>  
					</li>
                    
               <?php endwhile;
            
               else :
               endif;
    
               wp_reset_postdata();
        
              ?>
         </ul>
       </div>
   
   
   
   
   
      <div class="latest_tweets">
         <h3 class="clr">Latest tweets</h3>
          <a class="twitter-timeline" href="https://twitter.com/CopSub"
          data-widget-id="398783478361100288" data-tweet-limit="3" data-show-replies="false" data-border-color="#fff" data-chrome="nofooter noheader noborders noscrollbar transparent">
          Tweets by @CopSub</a>
      </div>
      
 
      
   </div>









</div>

<?php } ?>

<?php // Section 4 --------------------------------------------------------------------------------

if ($front_section_4_active) { 

?>


<div style="position:absolute; top:<?php echo $section_4_top_position?>px; left: 0px; height: <?php echo $section_4_height?>px; width:100%; margin-left: auto; margin-right: auto; background-color: #9a9a9a; background-image:url('<?php echo $themepath?>/img/front-spica-bck.jpg'); background-position: center top;background-repeat:no-repeat; background-color: #9a9a9a;">
</div>

<?php } ?>

<?php // Section 5 --------------------------------------------------------------------------------

if ($front_section_5_active) { 

?>

<?php //Bottom section ?>
<div  style="position:absolute; top:<?php echo $section_5_top_position?>px; left: 0px; height: <?php echo $section_5_height?>px; width:100%; margin-left: auto; margin-right: auto; background-color: transparent; background-image:url('<?php echo $themepath?>/img/front-bottom-bck.jpg'); background-position: center top;background-repeat:no-repeat; background-color: #9a9a9a;" >






<div style="position: relative; width:100%; margin-top: 340px;">
<div style="background-color: #9a9a9a; padding-bottom: 55px; padding-top: 25px; padding-right: 90px; padding-left: 90px; margin: 0 auto; width: 530px;  text-align: center;">
<table style="width:100%"><tr>
<td style="width: 500px;font: 22px helvetica, sans-serif; font-weight: normal; color: #000; line-height:25px;">
We’re 100 % crowdfunded.</br>
Donate or join the support group.</br>
 your money is the rocketfuel! 
 </td>
<td>&nbsp;</td>
</tr></table>
</div>
</div>






<div style="position: relative; width:100%; margin-top: -40px;z-index:10;">
<div style="padding-right: 0px; margin: 0 auto; width: 167px;">
<div>
<a href="<?php echo (site_url().'/support-us/'); ?>"  onclick="_gaq.push(['_trackEvent','Support','Click','Donate on bottom FP']);"><div class="front_donbut"></div></a>

</div>
</div>
</div>

</div>


<?php } ?>




<div style="position:absolute; top:<?php echo $section_6_top_position?>px; left: 0px; height: <?php echo $section_6_height?>px; width:100%; margin-left: auto; margin-right: auto; background-color: #9a9a9a; background-image:url('<?php echo $themepath?>/img/blackbck.jpg'); background-position: center top;background-repeat:repeat-y;z-index:5;">








<span id="preload-01"></span>



<?php get_footer('frontlaunch'); ?>