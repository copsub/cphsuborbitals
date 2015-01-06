<?php get_header(); ?>

<div class="main-area">

	<?php while ( have_posts() ) : the_post(); ?>

        <article>
          <div class="entry-content">
          
       <?php 
		   get_template_part( 'content', get_post_format() ); 
       ?>       
             
          </div>
        </article>

    <?php endwhile; ?>

    <?php get_template_part( 'loop', 'nav' ); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>