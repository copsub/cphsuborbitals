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
//$url_for_steaming_link = get_field( 'url_for_steaming_link',  $frontpage_id );
 $url_for_steaming_link = get_youtube_streaming_url_from_text_file();
// $top_text_section = get_field( 'top_text_section',  $post->ID  );

  //var from settings page
  $launch_time_date = get_field( 'launch_time_date', 'option' );
  $launch_date = date('F jS', strtotime($launch_time_date));
  $launch_message = get_field( 'front_launch_message', 'option' );
  $time_hiding_countdown_frontpage = get_field( 'time_hiding_countdown_frontpage',  'option' );
  $show_countdown_on_frontpage = get_field( 'show_countdown_on_frontpage',  'option' );
 
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
					</header>

                    <section class="text">
                    
                    <div style="width:610px;padding-bottom: 20px;">

<?php                    

		//		echo '<div class="front_launch_message">Current estimated launch: July 16th</div>';

											
											
							
		switch ($show_countdown_on_frontpage) {
			case "hidden":
				echo '';
				break;
			case "message":
				echo '<div class="front_launch_message">'.$launch_message.' '.$launch_date.'</div>';
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
           
                    </div>
                       
   <?php

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
      'category_name'           => 'nexoe_news',
	  'order'                   => 'date'
   ) );
   
   ?>
   
   
          <?php // lastest news col ?>
       <div class="latest_news">
          <h3 class="clr">Latest Nexø news</h3>
            <ul class="news">
            
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
   
   
   
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
            			<?php the_content(); ?>
         




			
			
						<div style="padding-left: 274px; padding-top: 10px;">
							<a href="#TB_inline?width=400&height=200&inlineId=CAWC_social_share_popup" class="thickbox">
							<img src="<?php echo $themepath?>/img/social-share.png" alt="Share Social" title="Share this"/>
							</a>
						</div>          

						
						
                    </section>    

						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>


					</div>

				</article>

				<?php //comments_template(); ?>
			<?php endwhile; ?>





</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>