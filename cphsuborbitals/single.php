<?php get_header(); ?>

<div class="main-area">

	<?php while ( have_posts() ) : the_post(); ?>

        <article>
          <div class="entry-content clr">
          
       <?php get_template_part( 'content', get_post_format() ); ?>       
       <a href="#" class="top">Back to top</a>
             
          </div>
        </article>

    <?php endwhile; ?>

    <?php get_template_part( 'author', 'description' ); ?>
    <?php get_template_part( 'loop', 'nav' ); ?>
    <?php comments_template(); // hybrid comment template ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>