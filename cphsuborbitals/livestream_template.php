<?php
/*
Template Name: Livestream template
*/

?>

<?php get_header(); 


  $server_name = $_SERVER['SERVER_NAME'];

  global $post;

 $frontpage_id = get_option('page_on_front');
 //$url_for_steaming_link = get_field( 'url_for_steaming_link',  $frontpage_id );
 $url_for_steaming_link = get_youtube_streaming_url_from_text_file();
?>


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
											
											<iframe width="878" height="494" src="https://www.youtube.com/embed/<?php echo $url_for_steaming_link; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </section>    

						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>


					</div>

				</article>

				<?php //comments_template(); ?>
			<?php endwhile; ?>





</div>
<?php get_footer(); ?>
