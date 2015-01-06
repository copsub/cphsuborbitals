<?php get_header(); ?>

<div class="main-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                   <div class="entry-content">
                       <header class="entry-header clr">
                       <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					   </header>
                       <?php the_content(); ?>
                   </div>
				</article>

				<?php //comments_template(); ?>
			<?php endwhile; ?>

<p style="margin:0 0 20px;"></p>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>