  <?php //if ( unit_ipad || unit_desktop ) : 
  
    $themepath = ( $server_name === 'sb1.local' ? 'http://sb1.local/wp-content/themes/cphsuborbitals' : CHILD_THEME_URI );

  
  ?>

<div style="position:absolute; top:6131px; left: 0px; height: 200px; width:100%; margin-left: auto; margin-right: auto; background-color: #9a9a9a; background-image:url('<?php echo $themepath?>/img/blackbck.jpg'); background-position: center top;background-repeat:repeat-y;z-index:5;">
        
        
        </div>

      </div> <?php // end div.main-container ?>
    </div>   <?php // end div.main.wrapper ?>

     <?php $footer = apply_filters( 'cphsuborb_footer', '' ); ?>


  <?php //endif; ?>

      <?php wp_footer();
	  
	 ?>

</body>
</html>