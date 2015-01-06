
    <?php
	  
	  global $wp_query;
	  
	  $author = array();
	  $author_id = $wp_query->posts[0]->post_author;
	  $author['description'] = get_the_author_meta( 'user_description', $author_id );
	  
	  if ( get_the_author_meta( 'description', $author_id ) ) : 

	    $author['id']        =  $author_id;
	    $author['fb']        =  get_the_author_meta( 'facebook', $author['id'] );
	    $author['twitter']   =  get_the_author_meta( 'twitter',  $author['id'] );
	    $author['linked_in'] =  get_the_author_meta( 'linkedin', $author['id'] );
	    $author['name']      =  get_the_author_meta( 'display_name', $author['id'] );

     ?>
	  
      <div class="author-info clr">
      
		  <div class="author-avatar">
			  <?php 
			  
			  if ( userphoto_exists( $author['id'] ) ) {
				  userphoto( $author['id'] );
			  } else {
				  echo get_avatar( get_the_author_meta( 'user_email' ) );
			  }
			  //echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'cphsuborbitals_author_bio_avatar_size', 60 ) ); ?>
              
		  </div>
          
		  <div class="author-descr">

			  <?php printf( __( 'Author: %s<br /><br />', 'cphsuborbitals' ), $author['name'] ); ?>
			  <?php printf( __( '%s' ), $author['description'] ); ?>
              
              <?php
			     
				 if ( is_single()  ) : 
				     
					 printf( __( '<br /><br />%s and read more articles written by %s', 'cphsuborbitals' ), 
				     '<a href="' . esc_url( get_author_posts_url( $author['id'] ) ) . '">' . __( 'Click here', 'cphsuborbitals' ) . '</a>',
				     $author['name'] ); 
				 
				 endif; 
				 
			   ?>

		  </div>
          
     <?php if ( !empty( $author['fb'] ) || !empty( $author['twitter'] ) || !empty( $author['linked_in'] ) ) : ?>
          
          <div class="social">
			
			<?php 
             if ( !empty( $author['fb'] ) ) : ?>
                 <a href="<?php echo $author['fb']; ?>" target="_blank" class="facebook">Facebook</a><br />
            <?php endif; ?>
            
            <?php 
			if ( !empty( $author['twitter'] ) ) : ?>
			   <a href="https://twitter.com/<?php echo $author['twitter']; ?>" class="twitter-follow-button" data-show-count="false" data-lang="da">
               <?php echo $author['twitter']; ?></a><br />
			<?php endif; ?>

            <?php if ( !empty( $author['linked_in'] ) ) : ?>
                 <a href="<?php echo $author['linked_in']; ?>" target="_blank" class="linked_in">LinkedIn</a>
            <?php endif; ?>
            
          </div>
          
     <?php endif; ?>     

	  </div>

      
<?php endif; ?>

