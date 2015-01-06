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
--------------------------------------
[ @-> add image sizes media uploader ]
--------------------------------------
*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'post-thumb-small', 260, 9999 ); 
	add_image_size( 'post-thumb-big', 655, 9999 ); 
	add_image_size( 'post-thumb-table', 600, 9999 ); 
	
	function cphsuborbitals_set_image_sizes( $sizes ) {
	
		$addsizes = array(
				'post-thumb-small' => __( 'Post thumbnail width 260 x auto' ),
				'post-thumb-big' => __( 'Post thumbnail width 655 x auto' ),
				'post-thumb-table' => __( 'Post thumbnail width 600 x auto' )
			 );
			
		$newsizes = array_merge( $sizes, $addsizes );
		return $newsizes;
	}

	add_filter('image_size_names_choose', 'cphsuborbitals_set_image_sizes');


/*
--------------------------------
[ @-> remove/add theme support ]
--------------------------------
*/	

    remove_theme_support( 'post-formats' );
    add_theme_support( 'loop-pagination' );
    add_theme_support( 'breadcrumb-trail' );
    add_theme_support( 'hybrid-core-shortcodes' );
//    add_theme_support( 'hybrid-core-widgets' );

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
				
				wp_register_script('youtube-api',  "http://www.youtube.com/player_api", array( 'jquery' ), '1.0', true );
				wp_enqueue_script('youtube-api');

			    wp_register_script( 'main-js',  "{$url}" . "/js/cphsuborbitals.js", array( 'jquery','youtube-api' ), '1.0', true );
			    wp_enqueue_script( 'main-js' );
				
			}
			


			wp_register_style( 'main-css', "{$url}" . '/css/main.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'main-css' );


		}
		
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
	

	add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


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

	add_action( 'wp', 'addShortcodes' );

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
	
	add_filter('body_class','child_add_category_to_single');


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
-----------------
[ @ search form ]
-----------------
*/

	function cphsuborbitals_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<div>
		  <input type="text" value="' . get_search_query() . '" name="s" placeholder="Search..." id="s" />
		  <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
		</div>
		</form>';
	
		return $form;
	}
	
	add_filter( 'get_search_form', 'cphsuborbitals_search_form' );

/*
--------------------------------------
[ @ remove width & height from image ]
--------------------------------------
*/

	/* prevents WP from putting default link on images */
	//add_action('pre_option_image_default_link_type', 'always_link_images_to_none');
	
	function always_link_images_to_none() {
		return 'none';
	}

	function add_lightbox_to_images( $content ) {

	   global $post;
		
	   $content = preg_replace( '/(height|width)=[\'\"]\d*[\'\"]\s/', '', $content );
	   $content = preg_replace( '/(\<img[\s+].*"[\s+]src=")(.[^\"]*)(.[^\>]*\>)/', '<a href="$2" class="lightbox-pictures" rel="lightbox['.$post->ID.']">$1$2$3</a>', $content );

	   return $content;
	   
	}
	

	function remove_width_and_height_attribute( $html ) {
	   $html = preg_replace( '/(height|width)=[\'\"]\d*[\'\"]\s/', '', $html );
	   return $html;
	}



/*
------------------
[ @ footer links ]
------------------
*/
  
  function cphsub_footer() {
	  
	  $footer = 
	  '2013-'. date("Y") .' Copenhagen Suborbitals. Absolutely no rights reserved';
	  $footer .= ' - <a style="color: white;" href="http://copsub.com/feed/">Blog rssfeed</a>';
	  return $footer;
  }

  add_filter( 'cphsuborb_footer', 'cphsub_footer' );


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
----------------------------
[ @-> download files setup ]
----------------------------
*/	
   
   function cphsuborbitals_download_files() {
	   
		   global $post;
		   $post_id = $post->ID;
		   
	       // download files
		   if ( get_field( '_repeater_fields', $post_id ) ) {
			   
		    $a = 0;
				   
			   while ( has_sub_field( '_repeater_fields', $post_id ) ) {
				   
				   if ( get_sub_field( '_download_file', $post_id ) ) {
					   
			           if ( $a === 0 ) printf( '<h3>Download</h3>' );

					   $file = get_sub_field( '_download_file', $post_id );
					   $file_title = ! empty( $file['title'] ) ? $file['title'] : '';
				       
					   $file_type = array(); 
				       $file_type['pdf'] = preg_match( '/pdf/', $file['mime_type'] );
				       $file_type['zip'] = preg_match( '/zip/', $file['mime_type'] );
				   
				       if ( $file_type['pdf'] )  printf( '<a href="%s" target="_blank" class="download_file clr" title="%s">Download pdf</a>', $file['url'], $file_title );
				       if ( $file_type['zip'] )  printf( '<a href="%s" target="_blank" class="download_file clr" title="%s">Download zip</a>', $file['url'], $file_title );
				
				   }
				   
				   $a+=1;
				   
			   } // end while
			   
			} // end if

		   // page facts
		   if ( get_field( '_facts', $post_id ) ) {
			  
			  $facts = get_field( '_facts', $post_id );
			  printf( '<h3>Facts</h3><div class="facts clr">%s</div>', $facts );
			  
		   }

		   // videos in overlay
		   if ( get_field( '_video_repeater', $post_id ) ) {
			   
		    $b = 0;
				   
			   while ( has_sub_field( '_video_repeater', $post_id ) ) {
				   
				   if ( get_sub_field( '_video_overlay', $post_id ) ) {
					   
			           if ( $b === 0 ) printf( '<h3>Videos</h3>' );

					   $video = get_sub_field( '_video_overlay', $post_id );
					   echo $video;
					   //$file_title = ! empty( $file['title'] ) ? $file['title'] : '';
				
				   }
				   
				   $b+=1;
				   
			   } // end while
			   
			} // end if
	  } 

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


function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
	<span class="comment-time-edit">
	<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-time">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(EDIT)' ), '  ', '' );
		?>
	</span>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
		<br />
	<?php endif; ?>



	<?php comment_text(); ?>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/*
-----------------------------------------------------------
[ @-> upme (user profile made easy) plugin customisations ]
-----------------------------------------------------------
*/
require_once( trailingslashit( dirname(__FILE__) ) . './library/upme_customisations.php' );



// Remove Product List RSS from webshop
remove_action('wp_head', 'wpsc_product_list_rss_feed');

?>