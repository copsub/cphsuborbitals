<?php

get_header(); ?>

<div class="main-area">
    
    <article>
      <div class="entry-content">
 <?php
	          
	  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
			  			  
	  /*if ( $term->description ) :
		  
		  echo '<div class="tax_descr">';		
		    
		    printf( '<h2 class="tax_title">Blog: %s</h2>', $term->name );
		    printf( '%s', $term->description );
			
		  echo '</div>';
				  
	  endif;*/
	    
      if ( have_posts() ) :

		while ( have_posts() ) : the_post();
			 get_template_part( 'content' );
		endwhile;

		get_template_part( 'loop', 'nav' );

	  else :
		get_template_part( 'content', 'none' );
	  endif;
		
    ?>

     </div>
   </article>
   
   </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>