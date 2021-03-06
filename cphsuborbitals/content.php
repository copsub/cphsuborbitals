<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

$post_videolink_code = get_field( 'post_videolink_code',  $post->ID  );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	

		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		<?php endif; // is_single() ?>




		<?php if ( is_single() ) : ?>
			<div class="entry-meta-single">
				
				<?php
if(!has_term('video', 'category', $post)) {
  twentythirteen_entry_meta();
}
 ?>

				
				<?php if ( comments_open() && ! is_single() ) : ?>
					<div class="comments-link">
						<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
					</div><!-- .comments-link -->
				<?php endif; // comments_open() ?>	
			</div><!-- .entry-meta -->
		<?php else : ?>
		
			
			
		<?php endif; ?>
		
		
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<?php elseif ( is_single() ) : ?>
	
					<?php
if(has_term('video', 'category', $post)) {
?>
<div style="margin-bottom:10px;">
	

<iframe width="878" height="494" src="https://www.youtube.com/embed/<?php echo $post_videolink_code; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
	</div>
<?php	
}
 ?>
	
	
			<?php the_content(); ?>
	<?php else : ?>
	<div class="entry-content">

			
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<?php if ( ! is_single() ) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		
		
						<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-meta">
				<?php copsub_entry_meta(); ?>	
			</div><!-- .entry-meta -->
			<?php else : ?>
			<div class="entry-meta-nothumb">
				<?php copsub_entry_meta(); ?>	
			</div><!-- .entry-meta -->
			<?php endif; ?>	
		
			
		<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>

		<p class="read-more clr"><a href="<?php the_permalink(); ?>">Read More</a></p>
					<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">


		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
