<?php get_header(); ?>
<div class="main-area">
    
    <article>
      <div class="entry-content">

<?php if ( strtolower( get_post_type() === 'news' ) ) {
	echo '<h3 class="news-blog">Blogs</h3>';
	}
?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
            
				<?php get_template_part( 'content', get_post_format() ); ?>
			
			<?php endwhile; ?>

		    <?php get_template_part( 'loop', 'nav' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
     
     </div>
   </article>
   
   </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>