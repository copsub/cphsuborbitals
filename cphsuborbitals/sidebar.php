<div class="side_bar">
<aside>

	<?php if ( is_active_sidebar( 'cphsuborbitals_sidebar_1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'cphsuborbitals_sidebar_1' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>




<?php

  if ( is_page() || is_single() ) {
	  // function cphsuborbitals_download_files() is called from function.php
	  cphsuborbitals_download_files();
  }
  

 
if(get_field('field_name'))
{
	echo '<div>' . get_field('_facts') . '</div>';
}
  
  
         
/*
------------------------
[ @-> submenu handling ]
------------------------
*/
/*
     global $post;
     $parent_id = get_ancestors( $post->ID, 'page' ); 
	 $parent_page_id = $parent_id ? $parent_id[0] : null;
	 
	 // parent page children
     if ( $parent_page_id ) {
    
        $args = array(
            'depth'        => 1,
            'show_date'    => '',
            'date_format'  => get_option('date_format'),
            'child_of'     => $parent_id[0],
            'exclude'      => '',
            'include'      => '',
            'title_li'     => '<h3>' . __( get_the_title( $post->post_parent ), 'cphsuborbitals' ) . '</h3>',
            'echo'         => 1,
            'authors'      => '',
            'sort_column'  => 'menu_order',
            'link_before'  => '',
            'link_after'   => '',
            'walker'       => '',
            'post_type'    => 'page',
            'post_status'  => 'publish' 
        );
       
	   echo '<ul class="sub_menu">';  
           wp_list_pages( $args );
	   echo '</ul>';  
         
     }
	 
	 // parent page
	 elseif ( ! $parent_page_id && is_page() ) {
		 
        $args = array(
            'depth'        => 1,
            'show_date'    => '',
            'date_format'  => get_option('date_format'),
			'child_of'     => $post->ID,
            'exclude'      => '',
            'include'      => '',
            'title_li'     => '<h3>' . __( get_the_title( $post->ID ), 'cphsuborbitals' ) . '</h3>',
            'echo'         => 0,
            'authors'      => '',
            'sort_column'  => 'menu_order, post_title',
            'link_before'  => '',
            'link_after'   => '',
            'walker'       => '',
            'post_type'    => 'page',
            'post_status'  => 'publish' 
        );

	   $sub_menu =  wp_list_pages( $args );
       
	   if ( $sub_menu ) {
		   echo '<ul class="sub_menu">';
		   echo $sub_menu;
		   echo '</ul>';  
	   }
		
	 }



/*
-------------------------
[ @-> gets latest blogs ]
-------------------------
*/
   
   $number_of_news = 6;
   $query_latest_blogs =  new WP_Query( array(
      'no_found_rows'           => true,  // counts posts, remove if pagination required
      'update_pos t_meta_cache' => false, // grabs post meta, remove if post meta required
      'update_post_term_cache'  => false, // grabs terms, remove if terms required (category, tag...)
      'post_type'               => array( 'post' ),
      'posts_per_page'          => $number_of_news,
	  'order'                   => 'date'
   ) );
   
   // lastest news col 
	 
   ?>
       
       <div class="latest_news">
          <h3 class="clr">Latest news</h3>
            <ul class="clr">
            
              <?php 
			  
			  if ( $query_latest_blogs->have_posts() ) : 
    
                  while ( $query_latest_blogs->have_posts() ) :	$query_latest_blogs->the_post();
				    echo '<li>';
                      printf( '<span class="date clr">%s</span>', get_the_date( 'd.m.Y' ) );
                      printf( '<a href="%s" class="clr"><strong>%s</strong></a>', get_permalink(), get_the_title() );
	
                  	  $content = wp_trim_words( strip_tags( get_the_content() ), 20 );				  
					 
						  echo 
						  '<a href="'.get_permalink( $post->id ).'">'
						  . $content
						  . '</a>';
					  
					echo '</li>';
                  endwhile;
            
               else :
    
	           endif;
    
               wp_reset_postdata();
        
              ?>
         </ul>
         </div>



</aside>

</div>

