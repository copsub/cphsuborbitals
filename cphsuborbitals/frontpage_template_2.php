<?php
/*
Template Name: Forside template 2 - warmode
*/
?>

<?php get_header(); 

  global $post;

  $image        =  get_field( '_frontpage_template_2_image', $post->ID ); 
  $image_width  =  $image['width'];
  $image_height =  $image['height'];
  $image_url    =  $image['url'];
  $image_url    =  '' !== $image_url ? $image_url : CHILD_THEME_URI . '/img/default.jpg';
  
  $title    =  get_field( '_frontpage_template_2_title', $post->ID );
  $text     =  get_field( '_frontpage_template_2_text',  $post->ID );
  $video_id =  esc_attr( strip_tags( trim( get_field( '_frontpage_template_2_video', $post->ID ) ) ) );
  
?>

<div class="frontpage template_2" style="background-image:url('<?php echo $image_url; ?>'); background-size:<?php echo $image_width; ?>px <?php echo $image_height; ?>px;" data-image-url="<?php echo $image_url; ?>">
  
  <div class="table first">
     <div class="tr">
        <div class="td">
                <strong><?php echo $title; ?></strong>
                <?php echo $text; ?>

              <div class="table">
                 <div class="tr">
                        <div class="td">
                            <div class="watch_us"><a href="#showvideo">watch us</a><span></span></div>
                     </div>    
                  </div>
               </div>
       </div>
     </div>
   </div>  


  <div class="youtube-front clr" data-youtube-id="<?php echo $video_id; ?>">
      <div>
         <div class="video"><span id="<?php echo $video_id; ?>"></span><span class="pause"></span></div>
       </div>
   </div>
     
     
</div>

<?php

/*
-------------------------
[ @-> gets latest blogs ]
-------------------------
*/

   $query =  new WP_Query( array(
      'no_found_rows'           => true, // counts posts, remove if pagination required
      'update_pos t_meta_cache' => false,  // grabs post meta, remove if post meta required
      'update_post_term_cache'  => false, // grabs terms, remove if terms required (category, tag...)
      'post_type'               => array( 'news' ),
      'posts_per_page'          => 3,
	  'order'                   => 'date'
   ) );
   
   ?>

   <div class="frontpage-content clr">
   
       <?php // lastest news col ?>
       <div class="latest_news">
          <h3 class="clr">Latest news</h3>
            <ul class="clr">
            
              <?php if ( $query->have_posts() ) : $query->have_posts();
    
                  while ( $query->have_posts() ) :	$query->the_post(); ?>
				    <li>
                    <?php
                      printf( '<span class="date">%s</span>', get_the_date( 'd.m.Y' ) );
                      printf( '<h2><a href="%s">%s</a></h2>', get_permalink(), get_the_title() );
					  printf( '<a href="%s">%s</a>', get_permalink(), wp_trim_words( strip_tags( get_the_content( '', TRUE ) ), 20 ) );
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
      
      <div class="latest_youtube">
         <h3 class="clr">Latest from youtube</h3>
      </div>
      
   </div>


<?php get_footer(); ?>
