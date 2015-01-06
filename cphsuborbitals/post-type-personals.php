
     <header class="entry-content">
        <h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
     </header>     
	 
     <ul>
	  <?php echo apply_atomic_shortcode( 'entry_by', '<li class="entry-by clr">' 
       . __( '<span class="author">Skrevet af:</span> [entry-author]', 'cphsuborbitals' ) 
       . '</li>' ); 
       ?>
     </ul>

     <ul>
	  <?php echo apply_atomic_shortcode( 'entry_date', '<li class="entry-date">'
       . __( '<span class="icon"></span>[entry-published before="" after=""]', 'cphsuborbitals' )
       . '</li>' );
       ?>
     </ul>

     <ul>
	  <?php
        echo apply_atomic_shortcode( 'entry_tags', '<li class="entry-tags">'
         . __( '<span class="icon"></span>[entry-terms before="" taxonomy="personal"]', 'cphsuborbitals' )
         . '</li>' );
         ?>
     </ul>

     
     <?php the_post_thumbnail( 'post-thumb-600', array( 'class' => 'post-img' ) ); ?>
	 <?php the_content( __( 'Læs mere...', 'cphsuborbitals' ) ); ?>