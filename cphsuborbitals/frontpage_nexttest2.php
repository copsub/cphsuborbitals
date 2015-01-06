<?php
/*
Template Name: Forside Next Test 2
*/
?>

<?php get_header(); 

  global $post;

  $title    =  get_field( '_title', $post->ID );
  $text_rov =  get_field( '_right_of_video',  $post->ID );
  $text_uv =  get_field( '_under_video',  $post->ID );
  $video_id =  get_field( '_video_id',  $post->ID );
  $datetime =  get_field( '_countdown_datetime',  $post->ID );
  $text_ov =  get_field( '_over_video',  $post->ID );  
  $text_hc =  get_field( '_headline_counter',  $post->ID );
  $img_vid =  get_field( '_tmp_image_video',  $post->ID );


?>

<div class="front-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">


					<header class="entry-header clr">
						<h1 class="entry-title"><?php echo $title; ?></h1>
					</header>

<div class="overvideo">  <?php echo $text_ov ?> </div>
<div>		
<h2 class="countdownhl">  <?php echo $text_hc ?> </h2>			
<?php echo do_shortcode('[ujicountdown id="NextTest" expire="'.$datetime.'" hide = "true"]'); ?>

<?php 
if ($video_id != '') {
?>
<div class="frontpagevideo">

<?php echo do_shortcode('[embedplusvideo height="360" width="450" editlink="http://bit.ly/1qWd6Kl" standard="http://www.youtube.com/v/'.$video_id.'?fs=1" vars="ytid='.$video_id.'&width=450&height=360&start=&stop=&rs=w&hd=0&autoplay=0&react=1&chapters=&notes=" id="ep3658" /]'); ?>


<?php 
} else {
?>
<div class="frontpagephoto"><img width="450" height="360" src="<?php echo $img_vid['url']; ?>" alt="<?php echo $img_vid['alt']; ?>" /></div>
<?php
}
?>

<?php 
if ($video_id != '') {
?>
<div class="rightofvideo">  <?php echo $text_rov ?> </div>
<?php 
} else {
?>
<div class="rightofpic">  <?php echo $text_rov ?> </div>
<?php
}
?>

</div>

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