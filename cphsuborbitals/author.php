<?php

get_header(); ?>

<div class="main-area">
    
    <article>
      <div class="entry-content">


<?php

    get_template_part( 'author', 'description' );
     
	if ( have_posts() ) :

	  while ( have_posts() ) : the_post();
		   get_template_part( 'content' );
	  endwhile;

	  get_template_part( 'loop', 'nav' );

	else :
	  //get_template_part( 'content', 'none' );
	  echo 'No posts where found';
	
	endif;
		
?>

     </div>
   </article>
   
   </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>