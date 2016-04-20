<?php get_header(); ?>

<div class="main-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">

			  <?php /*if ( current_theme_supports( 'breadcrumb-trail' ) ) {  ?>
              
                   <div id="breadcrumb" class="clr">
                     <?php breadcrumb_trail( array( 'container' => 'nav', 'separator' => '&rsaquo;', 'before' => __( '', 'cphsuborbitals' ), 'front_page' => false ) ); ?>
                   </div>
               
              <?php  }*/ ?>

					<header class="entry-header clr">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php //the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>

                    <section class="text">
						<?php the_content(); ?>
                    </section>    

						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>


					</div>

				</article>

				<?php //comments_template(); ?>
			<?php endwhile; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>