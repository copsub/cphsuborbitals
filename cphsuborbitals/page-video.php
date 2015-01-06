<?php get_header(); ?>

<div class="main-area">

	<?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">

      <?php /*if ( current_theme_supports( 'breadcrumb-trail' ) ) {  ?>
      
           <div id="breadcrumb" class="clr">
             <?php breadcrumb_trail( array( 'container' => 'nav', 'separator' => '&rsaquo;', 'before' => __( '', 'cphsuborbitals' ) ) ); ?>
           </div>
       
      <?php  }*/ ?>

            <header class="entry-header clr">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <p style="margin:0 0 20px;"></p>
            </header>

            </div>

        </article>

        <?php // comments_template(); ?>
    <?php endwhile; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>