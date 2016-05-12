<?php
/*
Template Name: Positions template
*/
?>

<?php 
	get_header(); 

	global $post;
	$pre_sponsors_text    =  get_field( '_pre_sponsors_text', $post->ID );
?>

<div class="main-area">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<header class="entry-header clr">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
     	<section class="text">
				<div>
					<?php the_content(); ?>
				</div>
				<table>
<?php 
	$type = 'positions';
 	$args=array(
  	'post_type' => $type,
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'caller_get_posts' => 1,
		'orderby' => 'title',
		'order'   => 'ASC'
 	);

 	$my_query = null;
 	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {
		while ($my_query->have_posts()) : $my_query->the_post(); 

			$logo_sponsor  =  get_field( '_sponsor_logo', get_the_id() );
?>
	    
					<tr><td><img src="<?php echo $logo_sponsor?>"></td></tr>
					<tr><td><h3><?php the_title(); ?></h3></td></tr>
				<tr><td><?php the_content(); ?></td></tr>
<?php						
			
		endwhile;
	}
	wp_reset_query();  // Restore global post data stomped by the_post().
?>
				
				</table>
			</section>   
			<div>
<?php
echo do_shortcode('[contact-form-7 id="11483" title="Contact form 1"]');
?>
				</div>
		</div>
	</article>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

