<?php
/*
Template Name: Livestream template
*/

?>

<?php get_header(); 

<?php get_header(); 
$server_name = $_SERVER['SERVER_NAME'];
$themepath = ( $server_name === 'sb1.local' ? 'http://sb1.local/wp-content/themes/cphsuborbitals' : CHILD_THEME_URI );

global $post;

$frontpage_id = get_option('page_on_front');
$url_for_steaming_link = get_youtube_streaming_url_from_text_file();
$mission_live_blog = get_field( 'mission_live_blog',  $post->ID  );
$about_the_mission_title = get_field( 'about_the_mission_title',  'option'  );
$about_the_mission_content = get_field( 'about_the_mission_content',  'option'  );
$about_the_mission_content_below = get_field( 'about_the_mission_content_below',  'option'  );
$url_link_ready = get_field( 'url_link_ready',  'option'  );



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
$mission_press_kit = get_field( 'mission_press_kit',  'option' );

?>


<div class="main-area">


			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">

			  <?php /*if ( current_theme_supports( 'breadcrumb-trail' ) ) {  ?>
              
                   <div id="breadcrumb" class="clr">
                     <?php breadcrumb_trail( array( 'container' => 'nav', 'separator' => '&rsaquo;', 'before' => __( '', 'cphsuborbitals' ), 'front_page' => false ) ); ?>
                   </div>
               
              <?php  }*/ ?>

					<header class="entry-header clr">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php //the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
						<h2>
							Today we test the BPM-5 engine with a possible gimbal setup
						</h2>
					</header>

                    <section class="text">
						<?php the_content(); ?>
											
											<iframe width="878" height="494" src="https://www.youtube.com/embed/<?php echo $url_for_steaming_link; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
											
											
											<table style="width: 100%; margin-top: 50px;">
	<tr>
		<td class="orange_button" style="height: 80px;text-align: center;" >
<a  style="color: white;font-weight: bold;font-size:25px;text-decoration: none; " href="<?php echo get_site_url(); ?>/support-us/">
	<div style=" padding: 33px 10px 30px 10px;">
		Donate here >
	</div>
</a>
		</td>
		<td style="width: 10%;">
		</td>
		<td style="width: 45%; padding: 20px 10px 10px 90px;background-color: #000">
			<div>
				<div style="margin-bottom: 5px;color: white;">
					Sign up for our newsletter here:
				</div>
			
	<?php echo do_shortcode('[mc4wp_form id="11166"]') ?>
				</div>
		</td>
	</tr>
</table>		
											
											
                    </section>    

						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>


					</div>

				</article>

				<?php //comments_template(); ?>
			<?php endwhile; ?>





</div>
<?php get_footer('mission'); ?>