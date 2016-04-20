<?php
/* Load the core HYBRID theme framework by Justin Tadlock MR. WP Guru himself :-) */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );

if ( class_exists( 'Hybrid' ) )  {
	new Hybrid();
	add_action( 'after_setup_theme', 'cphsuborbitals_theme_setup', 11 );
}

function cphsuborbitals_theme_setup() {

	$prefix = hybrid_get_prefix();

    if ( ! isset( $content_width ) ) {
		$content_width = 665;
	}
	
	define( 'CBH_PATH', trailingslashit( dirname(__FILE__) ) );

/*
-----------------------------
[ @-> simple unit detection ]
-----------------------------
*/

require_once( CBH_PATH . '/library/detect_unit.php' );


/*
-----------------------
[ @ LESS PHP compiler ]
-----------------------
*/

  require_once( CBH_PATH . '/library/lessphp/lessc.inc.php' );
  $less = array();
  $less['main'] = new lessc;	
  $less['main']->checkedCompile( CBH_PATH . '/css/main.less', CBH_PATH . '/css/main.css');

/*
-----------------------------------------------
[ @-> remove unwanted elements from wp_header ]
-----------------------------------------------
*/

   remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
   remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
   remove_action( 'wp_head', 'index_rel_link' ); // index link
   remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
   remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
   remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
   remove_action( 'wp_head', 'wp_generator', 1 ); // Display the XHTML generator that is generated on the wp_head hook, WP version


/*
--------------------------------
[ @-> remove/add theme support ]
--------------------------------
*/	

    remove_theme_support( 'post-formats' );
    add_theme_support( 'loop-pagination' );
    add_theme_support( 'breadcrumb-trail' );
//    add_theme_support( 'hybrid-core-shortcodes' );


/*
------------------------------------
[ @-> unregister/register sidebars ]
------------------------------------
*/	

	function cphsuborbitals_remove_widgets() {
		// Unregister hybrid´s sidebars
		unregister_sidebar( 'sidebar-1' );
		unregister_sidebar( 'sidebar-2' );
	}

	add_action( 'widgets_init', 'cphsuborbitals_remove_widgets', 11 );


	function cphsuborbitals_register_sidebars() { 
		register_sidebar(
			array( 
				'name'           =>  __( 'Sidebar 1', 'cphsuborbitals' ), 
				'id'             =>  'cphsuborbitals_sidebar_1', 
				'description'    =>  __( 'Sidebar 1', 'cphsuborbitals' ), 
				'before_widget'  =>  '',
				'after_widget'   =>  '',
				'before_title'   =>  '<h3>', 
				'after_title'    =>  '</h3>' 
		 ));

		register_sidebar(
			array( 
				'name'           =>  __( 'Sidebar 2', 'cphsuborbitals' ), 
				'id'             =>  'cphsuborbitals_sidebar_2', 
				'description'    =>  __( 'Sidebar 2', 'cphsuborbitals' ), 
				'before_widget'  =>  '',
				'after_widget'   =>  '',
				'before_title'   =>  '<h3>', 
				'after_title'    =>  '</h3>' 
		 ));

	}

	add_action( 'widgets_init', 'cphsuborbitals_register_sidebars' );

/*
-------------------------------
[ @ load javascripts + jquery ]
-------------------------------
*/

	function cphsuborbitals_add_scripts() {
    
		if ( ! is_admin() ) {
		    
			$url = CHILD_THEME_URI;
			


			// video gallery Youtube
			if ( is_front_page() ) {
				
				//wp_register_script('youtube-api',  "http://www.youtube.com/player_api", array( 'jquery' ), '1.0', true );
				//wp_enqueue_script('youtube-api');

			    wp_register_script( 'main-js',  "{$url}" . "/js/cphsuborbitals.js", array( 'jquery','youtube-api' ), '1.0', true );
			    wp_enqueue_script( 'main-js' );
				
			}
			


			wp_register_style( 'main-css', "{$url}" . '/css/main.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'main-css' );


		}
			wp_enqueue_script('share42', "{$url}" . '/js/share42.js');
			wp_enqueue_script('donation', "{$url}" . '/js/donation.js');

	}

	add_action( 'wp_enqueue_scripts', 'cphsuborbitals_add_scripts', 100 );


/*
-------------------------------------
[ @ Remove jump #hash tag from link ]
-------------------------------------
*/
	  
	function remove_more_link_scroll( $link ) {
		  $link = preg_replace( '|#more-[0-9]+|', '', $link );
		  $link = '<p class="read-more clr">' . $link . '</p>';
		  return $link;
	}
	

//	add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


/*
-------------------
[ @ menu handling ]
-------------------
*/    

    function cphsuborbitals_menu() {
		
	  if ( has_nav_menu ( 'primary' ) ) {
		  $menu_arg = array( 
		    'theme_location'  => 'primary',
		    'menu'            => '',
			'menu_class'      => 'sf-menu',
		    'menu_id'         => '',
		    'echo'            => true,
		    'before'          => '',
		    'after'           => '',
		    'link_before'     => '',
		    'link_after'      => '',
		    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		    'depth'           => 3
	  );
	      wp_nav_menu( $menu_arg );
	    }
	}
	 

/*
-----------------------
[ @ handling personel ]
-----------------------
*/   

	// example: cphsuborbitals_retrieve_personnel( $post_type = 'personel', $taxonomy = 'team', $terms_id = 4 ); 

	function cphsuborbitals_retrieve_personnel( $post_type=null, $taxonomy=null, $terms_id=null ) {
		
		if ( $post_type && $taxonomy && $terms_id ) {
			global $wpdb;
			$query = "
			  SELECT id, post_title, post_content, guid FROM $wpdb->posts
			  LEFT JOIN $wpdb->term_relationships ON( $wpdb->posts.ID = $wpdb->term_relationships.object_id )
			  LEFT JOIN $wpdb->term_taxonomy ON( $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id )
			  LEFT JOIN $wpdb->terms ON( $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id )
			  WHERE $wpdb->terms.term_id = $terms_id
			  AND $wpdb->term_taxonomy.taxonomy = '$taxonomy'
			  AND $wpdb->posts.post_status = 'publish'
			  AND $wpdb->posts.post_type = '$post_type'
			  ORDER BY $wpdb->posts.post_title ASC
		   ";
		   //AND $wpdb->posts.post_date < NOW()
			 $results = $wpdb->get_results( $query, OBJECT );
			 return $results;
		
		}

	}


/*
----------------
[ @ shortcodes ]
----------------
*/

//	add_action( 'wp', 'addShortcodes' );

	function addShortcodes() {
		
		if ( is_front_page() ) {
			include_once( CBH_PATH . 'library/shortcodes_front.php' );
		} else {
			include_once( CBH_PATH . 'library/shortcodes_generel.php' );
		}

	}
	

/*
------------------------------
[ @ adds class to singlepage ]
------------------------------
*/

	function child_add_category_to_single( $classes ) {

		if ( is_single() ) {
			global $post;
			foreach( ( get_the_category($post->ID) ) as $category ) {
				// add category slug to the $classes array
				$classes[] = $category->category_nicename;
			}
		}
		
		if ( is_page('about') ) $classes[] = 'about-us';
		if ( is_page('video') ) $classes[] = 'video';
		if ( is_page('picture-gallery') ) $classes[] = 'picture-gallery';
		
		// return the $classes array

		return $classes;

	}
	
//	add_filter('body_class','child_add_category_to_single');


/*
------------------------------------
[ @ change titel of featured image ]
------------------------------------
*/

	function cphsuborbitals_relabel_feautured_image( $content ) {
	
		global $post_type, $current_screen;
		
		if ( 'personel' == $post_type && $current_screen->id == 'personel' ) { ?>
			  <script type="text/javascript">
				  jQuery( document).ready( function($) {
					  $('#postimagediv > h3').empty().text('Picture of coworker');
					  $('#postimagediv').find('#remove-post-thumbnail').empty().text('Remove coworker');
				  });
			  </script>
		<?php
	
		}
	}
	
	add_filter( 'admin_head', 'cphsuborbitals_relabel_feautured_image' );
		  



/*
-------------------------------------------
[ @ add custom columns in admin interface ]
-------------------------------------------
*/	

	function cphsuborbitalt_personel_cpt_columns( $columns ) {
		
		$new_columns = array(
		   '_job_area' => __('Jobtitel', 'cphsuborbitals'),
		   'featured_image' => __('Profil billede', 'cphsuborbitals'),
		);
         
		 return array_merge( $columns, $new_columns );
    }

    add_filter( 'manage_personel_posts_columns', 'cphsuborbitalt_personel_cpt_columns' );


    function cphsuborbitals_columns_content( $column_name, $post_ID ) {
		
		switch( $column_name ) {

	    case 'featured_image' :
			$thumbnail = get_the_post_thumbnail( $t->id, '90-120', array('class' => 'personnel-img' ) ) ? 
			get_the_post_thumbnail( $post_ID, '90-120', array('class' => 'personnel-img' ) ) : '<img src="' . CHILD_THEME_URI . '/img/siluet.jpg" class="personnel-siluet" alt="" />';
			echo $thumbnail;
		break;
		
	    case '_job_area' :
			echo get_field( '_job_area', $post_ID );
		break;	
	   
	   }

	}  

    add_action( 'manage_personel_posts_custom_column', 'cphsuborbitals_columns_content', 10, 2 ); 
	

   function cphsuborbitals_columns_filter( $columns ) {
     
	 unset($columns['author']);
     unset($columns['date']);
     
	 return $columns;
   }

    add_filter( 'manage_edit-personel_columns', 'cphsuborbitals_columns_filter',10, 1 );


/*
--------------------------
[ @-> add custom classes ]
--------------------------
*/	

    function cphsuborbitals_body_class( $classes ) {

		if ( is_page('support-us') ) $classes[] = 'support';

		return $classes;
	}
	
	add_filter( 'body_class', 'cphsuborbitals_body_class', 10, 1 );



/*
----------------------------------------
[ @-> Check A User’s Role in WordPress ]
----------------------------------------
*/	

	function copsub_get_user_role( $user_role=null ) {

		if ( ! $user_role ) return;
		
		$user = wp_get_current_user();
		
		if ( is_array( $user->roles ) ) {
			if ( in_array( $user_role, $user->roles ) ) {
				return true;
			} else {
				return false;
			}
		}

	}
	 

	function measure_number_of_queries() {
		return sprintf( __( 'This page loaded in %1$s seconds with %2$s database queries.', 'cphsuborbitals' ), timer_stop( 0, 3 ), get_num_queries() );
	}

	
	function my_theme_custom_upload_mimes( $existing_mimes ) {
	$existing_mimes['blend'] = 'application/blender';

	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter( 'mime_types', 'my_theme_custom_upload_mimes' );

} // end child theme cphsuborbital




/*
-----------------------------------------------------------
[ @-> upme (user profile made easy) plugin customisations ]
-----------------------------------------------------------
*/
require_once( trailingslashit( dirname(__FILE__) ) . './library/upme_customisations.php' );



// Remove Product List RSS from webshop
remove_action('wp_head', 'wpsc_product_list_rss_feed');


/*
-----------------------------------------------------------
[ @-> Blog entry meta ]
-----------------------------------------------------------
*/
Function copsub_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		//echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	//if ( 'post' == get_post_type() ) {
	//	printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
	//		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	//		esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
	//		get_the_author()
	//	);
	//}
}

/*
-----------------------------------------------------------
[ @-> Excerpt and content length ]
-----------------------------------------------------------
*/

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

?>
