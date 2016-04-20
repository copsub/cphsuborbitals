<?php
/*
Template Name: CS Tasks Template
*/

$cpt_post_type = 'copsub_tasks'; //Choose the custom post type.

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article>

			<div class="personnel"><h3>CS Opgavecentral</h3></div>
						
			<div>
			
			<a href="http://copenhagensuborbitals.com/wp-admin/post-new.php?post_type=copsub_tasks">Opret opgave</a> - 
			<a href="http://copenhagensuborbitals.com/wp-admin/edit-tags.php?taxonomy=cstask_area&post_type=copsub_tasks">Tilføj kategori</a>
			
			</div>
			
			<?php 
			$cstask_area_terms = get_terms('cstask_area');
			foreach ($cstask_area_terms as $cpt_type_value) {
						
			?>
			
			
			
			<h3><?php echo($cpt_type_value->name); ?></h3>

			
			
			
			
			
			
			

			
			
			
			
						<table style="border-collapse: collapse;">
			<th style="background-color:#AAA; padding-top: .5em; padding-bottom: .5em;">Opgave</th>
			<th style="background-color:#AAA; padding-top: .5em; padding-bottom: .5em;">Info</th>
			<th style="background-color:#AAA; padding-top: .5em; padding-bottom: .5em;">Ansvarlig</th>
			<th style="background-color:#AAA; padding-top: .5em; padding-bottom: .5em;">Deadline</th>
			<?php		
  		// set up or arguments for our custom query
 			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
 			$query_args = array(
    		'post_type' => $cpt_post_type,
    		'post_status' => 'publish',
    		'posts_per_page' => 50,
   			'caller_get_posts' => 1,	
				'orderby' => 'date',
				'order'   => 'DESC',
    		'paged' => $paged,
    		'cstask_area' => $cpt_type_value->slug
  		);	

  		// create a new instance of WP_Query
  		$the_query = null;
  		$the_query = new WP_Query( $query_args );



			if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop 
				$post_meta_data = get_post_meta(get_the_id());
	 			$cs_ansvarlig  =  get_field( 'cs_ansvarlig', get_the_id() );
	 			$deadline  =  get_field( 'deadline', get_the_id() );
			?>
			

			<tr>
			<td style="border: 1px solid black; width:250px; padding-top: .5em; padding-bottom: .5em;"><a href="<?php echo get_permalink(get_the_id()); ?>"><?php the_title(); ?></a></td>
			<td style="border: 1px solid black; padding-top: .5em; padding-bottom: .5em;"><?php echo get_the_excerpt() ?><div><a href="<?php echo get_edit_post_link(get_the_id())?>">Edit</a></div></td>
			<td style="border: 1px solid black;width:150px;padding-top: .5em; padding-bottom: .5em;text-align:center;"><?php echo $cs_ansvarlig ?></td>
			<td style="border: 1px solid black;width:150px;padding-top: .5em; padding-bottom: .5em;text-align:center;"><?php echo $deadline ?></td>
			</tr>


	<?php endwhile; ?>

			</table>




	<?php 
	
		if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
			<nav class="prev-next-posts">
    			<div class="prev-posts-link">
      			<?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
    			</div>
    			<div class="next-posts-link">
      			<?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
    			</div>
  			</nav>
		<?php 
		}



	?>

	



	<?php else: ?>
  		<article>
    	<h1>Sorry...</h1>
    	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  		</article>
	<?php endif; ?>
			
			
			
			
			
			
			
			
			
			
			
	<?php		
			
			
			
//			print_r($cpt_type_value);
			?>


			<?php
}
?>
			





		</article><!-- #post-##  Begins in "template-parts/content-custom.php --> 

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer('cstask'); ?>















