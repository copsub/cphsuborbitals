<?php get_header(); ?>

<div class="main-area">

			<?php while ( have_posts() ) : the_post(); ?>
            
            <?php the_content(); ?>
            
			<?php endwhile; ?>

<p style="margin:0 0 20px;"></p>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>