<?php get_header(); ?>

<div class="main-area">
   <div class="personnel clr">

<?php

$taxonomy_terms = get_terms('team'); 

$terms     = array();
$personnel = array();


foreach( $taxonomy_terms as $term ) :

	//cphsuborbitals_retrieve_personnel( $post_type, $taxonomy, $terms_id ); 
	$personnel[] = array( 'term_id' => $term->term_id, 'result' => cphsuborbitals_retrieve_personnel( 'personel', 'team', $term->term_id ) );

endforeach;


foreach ( $personnel as $p ) :
	
	foreach ( $p as $v=>$k ) :
		
		echo '<div class="clr" style="margin:0 0 30px;">';
        
		// gets terms from taxonomy "team" 
		if ( $v == 'term_id' ) {
			$term = get_term( $k, 'team' );
			echo '<h3>' 
			. $term->name 
			. '</h3' . "\n";
		}
		
			foreach( $k as $t ) {

                // gets jobarea short description
				$jobarea = get_field( '_job_area', $t->id );
				$thumbnail = get_the_post_thumbnail( $t->id, '90-120', array('class' => 'personnel-img' ) ) ? 
				get_the_post_thumbnail( $t->id, '90-120', array('class' => 'personnel-img' ) ) : '<img src="' . CHILD_THEME_URI . '/img/siluet.jpg" class="personnel-siluet" alt="" />';

				echo
				'<div style="margin:0 0 20px;" class="row clr">' 
				  . '<div class="personnel-img">' . $thumbnail . '</div>' . "\n"
				  . '<div class="personnel-descr">' . "\n"
				  . '<h4>' . $t->post_title . '</h4>' . "\n"
				  . '<span style="float:left; width:100%; display:block; font-size:13px; line-height:13px; font-weight:700; color:#666; padding:0 0 20px;" class="clr">' . $jobarea . '</span>'
				  . $t->post_content . "\n"
				  . '</div>'
				. '</div>';
			
			}
			
  endforeach;

	echo '</div>'; // end coworker div

endforeach;

?>

</div>

<p style="margin:50px 0 20px;" class="clr"></p>
<div class="fb-like" data-href="<?php echo get_permalink( get_the_ID() ); ?>" data-width="450" data-layout="button_count" data-show-faces="false" data-send="true"></div>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>