
    <?php /*if ( current_theme_supports( 'breadcrumb-trail' ) ) {  ?>
    
         <div id="breadcrumb" class="clr">
           <?php breadcrumb_trail( array( 'container' => 'nav', 'separator' => '&rsaquo;', 'before' => __( '', 'cphsuborbitals' ), 'front_page' => false ) ); ?>
         </div>
     
    <?php  }*/ ?>

    <header class="entry-header clr">
		   <?php /* if ( has_post_thumbnail() && ! post_password_required() ) : ?>
              <div class="entry-thumbnail"><?php the_post_thumbnail(); ?></div>
           <?php endif; */ ?>

       <?php echo apply_atomic_shortcode( 'entry_by', '<div class="publish_date clr">[entry-published format="m.j.Y" after=" | "][entry-author before="By "]</div>'); ?> 
	   <h1 class="entry-title"><?php the_title(); ?></h1>

	 </header>
     
     <section class="text">
   
     <?php 
		
		the_content(); 

		if ( get_field( '_press_file' ) ) :
		    $__file = get_field( '_press_file' );
		    printf( '<a href="%s" target="_blank" title="%s" class="pdf-file">Download PDF</a>', $__file['url'], $__file['title'] );
		endif;
		
	 ?>
   
     </section>

      <ul>  
		<?php echo apply_atomic_shortcode( 'entry_tags', '<li class="entry-tags cat">'
			  . __( '[entry-terms before="Posted in: " taxonomy="blog"]', 'cphsuborbitals' )
			  . '</li>' );
		?>	  

		<?php echo apply_atomic_shortcode( 'entry_tags', '<li class="entry-tags">'
			  . __( '[entry-terms before="Tagged in: " taxonomy="post_tag"]', 'cphsuborbitals' )
			  . '</li>' );
		?>	  

      </ul>

		<div class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'cphsuborbitals' ), '<span class="edit-link">', '</span>' ); ?>
		</div>


