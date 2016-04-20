<?php get_header(); 
?>


<div class="main-area">


	<?php while ( have_posts() ) : the_post(); ?>

        <article>
          <div class="entry-content clr">
          
       <?php 
	   
	       $terms = get_the_terms( $id, 'blog' );
		   
		   if ( $terms && ! is_wp_error( $terms ) ) :
	
				  $copy_terms = array();
				  
				  foreach ( $terms as $term ) {
					  $copy_terms[] = $term->term_id;
				  }
							
				  $copy_terms = join( ', ', $copy_terms );
				  
				  if ( preg_match( '/20/', $copy_terms ) ) : // terms id 20 | press
	
					  get_template_part( 'content', 'press' ); 
				  
				  else :
	
					  get_template_part( 'content', get_post_format() ); 
	
				  endif;
				
			endif;
			
        ?>       
             
          </div>
        </article>

    <?php endwhile; ?>

    <?php get_template_part( 'author', 'description' ); ?>
    <?php get_template_part( 'loop', 'nav' ); ?>
    <?php comments_template(); // hybrid comment template ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<!-- patata single-news -->
