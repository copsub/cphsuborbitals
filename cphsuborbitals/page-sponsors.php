<?php
/*
Template Name: Sponsors template
*/
?>

<?php get_header(); 

 global $post;

 $pre_sponsors_text    =  get_field( '_pre_sponsors_text', $post->ID );
 $gold_company_sponsors    =  get_field( '_gold_company_sponsors', $post->ID );
 $silver_company_sponsors    =  get_field( '_silver_company_sponsors', $post->ID );
 $private_cash_donations    =  get_field( '_private_cash_donations', $post->ID );
?>

<div class="main-area">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<header class="entry-header clr">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

        	<section class="text">
				<?php 
					echo $pre_sponsors_text;
					echo $gold_company_sponsors;
					
					echo "<table>";
					
					
					$type = 'spons';
					$args=array(
					  'post_type' => $type,
					  'post_status' => 'publish',
					  'posts_per_page' => -1,
					  'caller_get_posts' => 1,
					  'orderby' => 'title',
					  'order'   => 'ASC',
					  'cat-spons' => 'gold-company-sponsor' );

					$my_query = null;
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
					  while ($my_query->have_posts()) : $my_query->the_post(); 
					  	$weblink_sponsor  =  get_field( '_sponsor_weblink', get_the_id() );
					  	$logo_sponsor  =  get_field( '_sponsor_logo', get_the_id() );
						if(strlen($weblink_sponsor) > 2) {
						if(strlen($logo_sponsor) > 2) {
					    ?>					    
					    <tr><td><a href="<?php echo $weblink_sponsor ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $logo_sponsor?>" width="60"></a></td></tr>
						<?php  } ?>
					    <tr><td><a href="<?php echo $weblink_sponsor ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></td></tr>
						<?php
						} else {
						
					    ?>					    
					    <tr><td><img src="<?php echo $logo_sponsor?>"></td></tr>
					    <tr><td><?php the_title(); ?></td></tr>
						<?php						
						}
						
						
					  endwhile;
						}
						wp_reset_query();  // Restore global post data stomped by the_post().


					echo "</table>";


					echo "<table>";
					
					echo $silver_company_sponsors;

					$type = 'spons';
					$args=array(
					  'post_type' => $type,
					  'post_status' => 'publish',
					  'posts_per_page' => -1,
					  'caller_get_posts' => 1,
					  'orderby' => 'title',
					  'order'   => 'ASC',
					  'cat-spons' => 'silver-company-sponsor' );

					$my_query = null;
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
					  while ($my_query->have_posts()) : $my_query->the_post(); 
					  	$weblink_sponsor  =  get_field( '_sponsor_weblink', get_the_id() );
					  	$logo_sponsor  =  get_field( '_sponsor_logo', get_the_id() );
					  	$hide_sponsorname  =  get_field( '_hide_sponsorname', get_the_id() );
						if(strlen($weblink_sponsor) > 2) {
						if(strlen($logo_sponsor) > 2) {
					    ?>					    
					    <tr><td><a href="<?php echo $weblink_sponsor ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $logo_sponsor?>" width="60"></a></td></tr>
						<?php  
						} 
						if($hide_sponsorname == FALSE) {
						?>
					    <tr><td><a href="<?php echo $weblink_sponsor ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></td></tr>
						<?php
						}
						} else {
						
					    ?>					    
					    <tr><td><img src="<?php echo $logo_sponsor?>"></td></tr>
					    <tr><td><?php the_title(); ?></td></tr>
						<?php						
						}
						
						
						
					  endwhile;
						}
						wp_reset_query();  // Restore global post data stomped by the_post().


					echo "</table>";


					echo $private_cash_donations;

					echo "<table>";

					$type = 'spons';
					$args=array(
					  'post_type' => $type,
					  'post_status' => 'publish',
					  'posts_per_page' => -1,
					  'caller_get_posts' => 1,
					  'orderby' => 'title',
					  'order'   => 'ASC',
					  'cat-spons' => '' );

					$my_query = null;
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
					  while ($my_query->have_posts()) : $my_query->the_post(); 
					  	$weblink_sponsor  =  get_field( '_sponsor_weblink', get_the_id() );
						$sponsor_country = get_field( 'sponsor_country', get_the_id() );
						$term_list = wp_get_post_terms(get_the_id(), 'cat-spons', array("fields" => "all"));
						$term_slug = $term_list[0]->slug;
						if (($term_slug != 'gold-company-sponsor') && ($term_slug != 'silver-company-sponsor')) {
					    ?>
					    
					    <tr><td><?php the_title(); ?></td><td><?php echo $sponsor_country; ?></td></tr>
						<?php
						}
						
					  endwhile;
						}
						wp_reset_query();  // Restore global post data stomped by the_post().
						
					echo "</table>";						
						?>
                    </section>    



					</div>

</article>

	

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

