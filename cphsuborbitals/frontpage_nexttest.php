<?php
/*
Template Name: Forside Next Test
*/
?>

<?php get_header(); 

  global $post;

  $title    =  get_field( '_title', $post->ID );
  $text_rov =  get_field( '_right_of_video',  $post->ID );
  $text_uv =  get_field( '_under_video',  $post->ID );
  $video_id =  get_field( '_video_id',  $post->ID );
  $datetime =  get_field( '_countdown_datetime',  $post->ID );
  
?>

<div class="front-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">


					<header class="entry-header clr">
						<h1 class="entry-title"><?php echo $title; ?></h1>
					</header>
					
<?php echo do_shortcode('[ujicountdown id="NextTest" expire="'.$datetime.'" hide = "true"]'); ?>

<?php echo do_shortcode('[video_lightbox_youtube video_id='.$video_id.' width=800 height=450 auto_thumb="1"]'); ?>

<div class="rightofvideo">  <?php echo $text_rov ?> </div>
<div class="undervideo">  <?php echo $text_uv ?> </div>

                    <section class="text">
						<?php the_content(); ?>
                    </section>    

						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>


					</div>

				</article>

				<?php //comments_template(); ?>
			<?php endwhile; ?>

</div>

<?php get_footer( 'front' ); ?>