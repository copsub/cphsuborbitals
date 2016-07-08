<?php
/*
Template Name: Mission Landingpage Template
*/
?>

<?php get_header(); 
$server_name = $_SERVER['SERVER_NAME'];
$themepath = ( $server_name === 'sb1.local' ? 'http://sb1.local/wp-content/themes/cphsuborbitals' : CHILD_THEME_URI );

global $post;

$frontpage_id = get_option('page_on_front');
$url_for_steaming_link = get_youtube_streaming_url_from_text_file();
$mission_live_blog = get_field( 'mission_live_blog',  $post->ID  );
$about_the_mission_title = get_field( 'about_the_mission_title',  'option'  );
$about_the_mission_content = get_field( 'about_the_mission_content',  'option'  );

//var from settings page
$launch_time_date = get_field( 'launch_time_date', 'option' );
$launch_date = date('F jS', strtotime($launch_time_date));
$launch_message = get_field( 'front_launch_message', 'option' );
$time_hiding_countdown_frontpage = get_field( 'time_hiding_countdown_frontpage',  'option' );
$show_countdown_on_frontpage = get_field( 'show_countdown_on_frontpage',  'option' );
$activate_war_mode = get_field( 'activate_war_mode',  'option' );

$mission_landing_page_title_l1_normal_mode = get_field( 'mission_landing_page_title_l1_normal_mode',  'option' );
$mission_landing_page_title_l2_normal_mode = get_field( 'mission_landing_page_title_l2_normal_mode',  'option' );
$mission_landing_page_title_l1_war_mode = get_field( 'mission_landing_page_title_l1_war_mode',  'option' );
$mission_landing_page_title_l2_war_mode = get_field( 'mission_landing_page_title_l2_war_mode',  'option' );
$mission_landing_page_top_logo = get_field( 'mission_landing_page_top_logo',  'option' );
$mission_content_top = get_field( 'mission_content_top',  'option' );
$estimated_mission_plan = get_field( 'estimated_mission_plan',  'option' );
$live_blog_description = get_field( 'live_blog_description',  'option' );
$for_the_press_content = get_field( 'for_the_press_content',  'option' );
$more_about_image = get_field( 'more_about_image',  'option' );




?>

<div class="main-area-full">
	<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">	
			<?php
/* SUB HEADER SECTION START ----------------------------------------------------------------------------------------------------------------------------  */ 
If ($activate_war_mode) 	{	
?>
			
<table style="width: 100%;">
	<tr>
		<td style="height: 100px;vertical-align:bottom; padding-bottom: 10px;">
		<div style="Color:black; Font-size:35px;font-weight: bold;line-height: 40px;"><?php echo $mission_landing_page_title_l1_war_mode ?></div>
		<div style="Color:#FF4F00; Font-size:35px;font-weight: bold; line-height: 40px;"><?php echo $mission_landing_page_title_l2_war_mode ?></div>
		</td>
		<td style="text-align:right; width: 200px;">
			<img src="<?php echo $mission_landing_page_top_logo[url] ?>" style="height:100px;">
		</td>
	</tr>
	<tr>
		<td colspan="2"  style="height: 50px;border-top: 1px solid black; 	border-collapse: collapse;border-top-color: #999999">
		</td>
	</tr>
</table>
			
			
<?php } else { ?>			
			
			
<table style="width: 100%;vertical-align:bottom;  padding-bottom: 10px;">
	<tr>
		<td style="height: 100px;" >
		<div style="Color:black; Font-size:35px;font-weight: bold;line-height: 40px;"><?php echo $mission_landing_page_title_l1_normal_mode ?></div>
		<div style="Color:#FF4F00; Font-size:35px;font-weight: bold; line-height: 40px;"><?php echo $mission_landing_page_title_l2_normal_mode ?></div>
		</td>
		<td style="text-align:right; width: 200px;">
			<img src="<?php echo $mission_landing_page_top_logo[url] ?>" style="height:100px;">
		</td>
	</tr>
	<tr>
		<td colspan="2"  style="height: 100px;border-top: 1px solid black; 	border-collapse: collapse;border-top-color: #999999">
			<div style="padding-top: 20px;"><?php echo $mission_content_top ?></div>
		</td>
	</tr>
</table>			
			
<?php			
	
}
/* SUB HEADER SECTION END ------------------------------------------------------------------------------------------------------------------------------  */ 
			
			If ($activate_war_mode) 	{		
			
/* LIVESTREAM SECTION START ----------------------------------------------------------------------------------------------------------------------------  */ 
			?>
			<section class="text">
<iframe width="878" height="494" src="https://www.youtube.com/embed/<?php echo $url_for_steaming_link; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
				<?php //_e( wp_oembed_get( $url_for_steaming_link ) ); ?>
     	<div style="padding: 20px 0 20px 0;">
			<?php
/* LIVESTREAM SECTION END  -----------------------------------------------------------------------------------------------------------------------------  */ 
			
			} 
			

			If ($activate_war_mode) 	{	
/* LIVEBLOG SECTION START -----------------------------------------------------------------------------------------------------------------------------  */ 
			?>
<table style="width: 100%;vertical-align:bottom;  padding-bottom: 10px; background-color: #e7e7e7">
	<tr>
		<td style="height: 60px; padding: 20px 10px 10px 10px;vertical-align:bottom;" >
			<span style="Color:black; Font-size:35px;font-weight: bold;line-height: 40px;padding-right: 10px;">Live blog</span>
			<span style="Color:black; Font-size:12px;font-weight: normal;line-height: 18px;"><?php echo $live_blog_description ?></span>
		</td>
	</tr>
	<tr>
		<td style="height: 270px; padding: 20px 10px 10px 10px;border-top: 1px solid black; 	border-collapse: collapse;border-top-color: #999999" >
			<?php the_content(); ?>
		</td>
	</tr>
</table>
				
				
				
			<?php		
/* LIVEBLOG SECTION END  ------------------------------------------------------------------------------------------------------------------------------  */ 
			} else {	

/* NEWS SECTION START ---------------------------------------------------------------------------------------------------------------------------------  */ 

   $query =  new WP_Query( array(
      'no_found_rows'           => true, // counts posts, remove if pagination required
      'update_pos t_meta_cache' => false,  // grabs post meta, remove if post meta required
      'update_post_term_cache'  => false, // grabs terms, remove if terms required (category, tag...)
      'post_type'               => array( 'post' ),
      'posts_per_page'          => 3,
      'category_name'           => 'nexoe_news',
	  'order'                   => 'date'
   ) );
   
   ?>

<table style="width: 100%;vertical-align:bottom;  padding-bottom: 10px; background-color: #e7e7e7">
	<tr>
		<td style="height: 270px; padding: 20px 10px 10px 10px;" >
			<div class="latest_news">
    	<ul style="list-style: none; margin: 0px;">
<?php if ( $query->have_posts() ) : $query->have_posts();
while ( $query->have_posts() ) :	$query->the_post(); ?>
		    <li>
<?php
	printf( '<div class="missionnews"><span>%s</span><a href="%s">%s</a></div>', get_the_date( 'd.m.Y' ), get_permalink(), get_the_title() );
  printf( '<div>%s</div>', wp_trim_words( strip_tags( get_the_content( '', TRUE ) ), 20 ) );
?>  
				</li>
                    
<?php endwhile;
               else :
               endif;
    
               wp_reset_postdata();
        
              ?>
         </ul>
       </div>	
			
		</td>
		<td style="width: 50%; padding: 20px 10px 10px 10px;">
			<?php echo $estimated_mission_plan ?>
		</td>
	</tr>
</table>
				
				

   
<?php   
/* NEWS SECTION END  ---------------------------------------------------------------------------------------------------------------------------------  */ 
  
}                    

/* NEWSLETTER-DONATE SECTION START --------------------------------------------------------------------------------------------------------------------  */ 

						If ($activate_war_mode) 	{	
			
				?>
	
<table style="width: 100%;  background-color: #FF4F00">
	<tr>
		<td style="height: 80px; padding: 33px 10px 10px 10px;text-align: center;" >
<a style="color: white;font-weight: bold;font-size:25px;text-decoration: none;" href="<?php echo get_site_url(); ?>/support-us/">Donate here ></a>
		</td>
		<td style="width: 50%; padding: 20px 10px 10px 10px;padding-left: 100px;">
			<div>
				<div style="margin-bottom: 5px;color: white;">
					Sign up for our newsletter here:
				</div>
			
	<?php echo do_shortcode('[mc4wp_form id="11166"]') ?>
				</div>
		</td>
	</tr>
</table>				
				
				

					
					

	
<?php
						}			
/* NEWSLETTER-DONATE SECTION END  ---------------------------------------------------------------------------------------------------------------------  */ 

				
				
				
/* MISSION EXPLAINED SECTION START -----------------------------------------------------------------------------------------------------------------------------  */ 
				
?>                    
            		
<table style="width: 100%;vertical-align:bottom;  padding-bottom: 10px; background-color: #FFF; margin-top: 20px;">
	<tr>
		<td style="height: 60px; padding: 20px 0 10px 0;vertical-align:bottom;" >
			<span style="Color:black; Font-size:35px;font-weight: bold;line-height: 40px;padding-right: 10px;"><?php echo $about_the_mission_title ?></span>
		</td>
	</tr>
	<tr>
		<td style="height: 270px; padding: 30px 0 10px 0;border-top: 1px solid black; 	border-collapse: collapse;border-top-color: #999999" >
  
  <?php echo $about_the_mission_content ?>		</td>
	</tr>
</table>				
				
				
				
				
				

				
				
				
<?php
/* MISSION EXPLAINED SECTION END  ------------------------------------------------------------------------------------------------------------------------------  */ 
				
/* MORE ABOUT SECTION START -----------------------------------------------------------------------------------------------------------------------------  */ 
				
?>
<a href="<?php echo get_site_url(); ?>/roadmap/nexo-i/" style="text-decoration: none;color: inherit;">			
					<div style="height: 450px; width: 100%; margin-bottom: 0; margin-top: 20px; display: block; margin-left: auto; margin-right: auto; background-color:#e7e7e7; background-image: url('<?php echo $more_about_image[url]; ?>'); background-repeat: no-repeat;background-position: center; ">
<div style="width: 500px;margin-left:350px;text-align: right;padding-top:20px;">
		<div style="Color:#FF4F00; Font-size:30px;font-weight: bold; line-height: 40px;padding-bottom:10px;">
			See the Nexø I rocket in detail
	</div>				
			<div>
			See our page with the Nexø I rocket information in all it's glorious detail.
	</div>				
	
						</div>

				</div>
				
	</a>				
<?php				
				
/* MORE ABOUT SECTION END -------------------------------------------------------------------------------------------------------------------------------  */ 
				

				
				
	/* NEWSLETTER-DONATE SECTION START --------------------------------------------------------------------------------------------------------------------  */ 

						If (!$activate_war_mode) 	{	
			
				?>
	
<table style="width: 100%;  background-color: #FF4F00">
	<tr>
		<td style="height: 80px; padding: 33px 10px 10px 10px;text-align: center;" >
<a style="color: white;font-weight: bold;font-size:25px;text-decoration: none;" href="<?php echo get_site_url(); ?>/support-us/">Donate here ></a>
		</td>
		<td style="width: 50%; padding: 20px 10px 10px 10px;padding-left: 100px;">
			<div>
				<div style="margin-bottom: 5px;color: white;">
					Sign up for our newsletter here:
				</div>
			
	<?php echo do_shortcode('[mc4wp_form id="11166"]') ?>
				</div>
		</td>
	</tr>
</table>				
				
				

					
					

	
<?php
						}			
/* NEWSLETTER-DONATE SECTION END  ---------------------------------------------------------------------------------------------------------------------  */ 
			
/* PR SECTION START -----------------------------------------------------------------------------------------------------------------------------  */ 
				
?>
	
				<table style="width: 100%;vertical-align:bottom;  padding-bottom: 10px; background-color: #FFF; margin-top: 30px;">
	<tr>
		<td style="height: 60px; padding: 20px 10px 10px 10px;vertical-align:bottom;" >
			<span style="Color:black; Font-size:35px;font-weight: bold;line-height: 40px;padding-right: 10px;">For the press</span>
		</td>
	</tr>
	<tr>
		<td style="height: 270px; padding: 20px 10px 10px 10px;border-top: 1px solid black; 	border-collapse: collapse;border-top-color: #999999" >
			<?php echo $for_the_press_content ?>
		</td>
	</tr>
</table>
				
				

				
				
<?php				
				
/* PR SECTION END -------------------------------------------------------------------------------------------------------------------------------  */ 
					
				


 ?>        

              </section>    

						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>


					</div>

				</article>


			<?php endwhile; ?>





</div>

<?php get_footer('mission'); ?>