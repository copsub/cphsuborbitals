<?php get_header(); ?>

<?php 
if(!has_term('video', 'category', $post)) {
?>
	<div class="main-area">
<?php
} else {
?>
 <div class="main-area" style="width: 98%;">
<?php
}


?>


	
	
	<?php while ( have_posts() ) : the_post(); ?>

        <article>
          <div class="entry-content clr">
          
       <?php get_template_part( 'content', get_post_format() ); ?>       

          </div>
        </article>

    <?php endwhile; ?>

    <?php get_template_part( 'author', 'description' ); ?>
    <?php get_template_part( 'loop', 'nav' ); ?>
    <?php comments_template(); // hybrid comment template ?>

</div>

<?php
if(!has_term('video', 'category', $post)) {
  get_sidebar(); 
}


?>


<?php 
if(!has_term('video', 'category', $post)) {
 get_footer(); 
} else {
	get_footer('mission'); 
	
}


?>




<!-- patata single.php -->
