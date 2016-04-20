  <?php 
  
    $themepath = ( $server_name === 'sb1.local' ? 'http://sb1.local/wp-content/themes/cphsuborbitals' : CHILD_THEME_URI );

  
  ?>

        
        
        </div>

      </div> <?php // end div.main-container ?>
    </div>   <?php // end div.main.wrapper ?>

     <?php $footer = apply_filters( 'cphsuborb_footer', '' ); ?>


      <?php wp_footer();
	  
	 ?>

</body>
</html>