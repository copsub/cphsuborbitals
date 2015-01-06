
	<?php if ( is_attachment() ) : ?>

		<div class="loop-nav">
			 <?php 
			 previous_post_link( '%link', '<span class="previous">' 
			 . __( '<span class="meta-nav">&larr;</span> Tilbage', 'cphsuborbitals' ) 
			 . '</span>' ); ?>
		</div>

	<?php 

	$post_type = get_post_type( get_the_ID() ); // henter den post type som den aktuelle artikel er tilknyttet
	elseif ( is_singular( $post_type ) ) : ?>

		<div class="loop-nav clr">
		  <?php

            $prev_post = get_adjacent_post( false, '', true );
			$next_post = get_adjacent_post( false, '', false );
			
			$next_prev_active   = !empty( $prev_post ) && !empty( $next_post ) ? 1 : 0;
			$next_active        =  empty( $prev_post ) && !empty( $next_post ) ? 1 : 0;
			$prev_active        = !empty( $prev_post ) &&  empty( $next_post ) ? 1 : 0;
            
            if ( $next_prev_active ) {
				
				echo '<a href="' . get_permalink( $prev_post->ID ) . '" title="Previous: ' . $prev_post->post_title . '" class="prev_post">' 
				. __( '&lsaquo; Previous', 'cphsuborbitals' ) . '</a>'; 

				echo '<a href="' . get_permalink( $next_post->ID ) . '" title="Next: ' . $next_post->post_title . '" class="next_post">' 
				. __( 'Next &rsaquo;', 'cphsuborbitals' ) . '</a>';
				
			}
			
			elseif ( $next_active && !$prev_active ) {
				
				echo '<a href="' . get_permalink( $next_post->ID ) . '" title="Next: ' . $next_post->post_title . '" class="next_post full">' 
				. __( 'Next &rsaquo;', 'cphsuborbitals' ) . '</a>';
				
			}
			
			elseif ( $prev_active && !$next_active ) {
				
				echo '<a href="' . get_permalink( $prev_post->ID ) . '" title="Previous: ' . $prev_post->post_title . '" class="prev_post full">' 
				. __( '&lsaquo; Previous', 'cphsuborbitals' ) . '</a>'; 
				
			}

          ?>
		</div>

	<?php elseif ( ! is_singular() && current_theme_supports( 'loop-pagination' ) ) : 

		  // read more about paginate_links arg at http://codex.wordpress.org/Function_Reference/paginate_links
          // pagination for archive, blog, and * search pages
	      loop_pagination( array( 

		     'before'    => '<div class="pagination loop-pagination">',
		     'after'     => '</div>',
		     'prev_text' => __( '<span class="meta-nav">&lsaquo;</span> Previous', 'cphsuborbitals' ), 
		     'next_text' => __( 'Next <span class="meta-nav">&rsaquo;</span>', 'cphsuborbitals' ),
			 'mid_size'  => 6, //(integer) (optional) How many numbers to either side of current page, but not including current page. Default: 2
			 'type'      => 'plain' // plain, array, list

		  ));  
	?>

	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( 
	array( 
	 'sep' => '', 
	 'prelabel' => '<span class="previous">' . __( '<span class="meta-nav">&larr;</span> Previous', 'cphsuborbitals' ) 
	 . '</span>', 'nxtlabel' => '<span class="next">' 
	 . __( 'Næste <span class="meta-nav">&rarr;</span>', 'cphsuborbitals' ) . '</span>' 
	))) : 
	?>

		<div class="loop-nav">
			<?php echo $nav; ?>
		</div>
        
	<?php endif; ?>