  <?php //if ( unit_ipad || unit_desktop ) : ?>

        <div class="push"></div>

      </div> <?php // end div.main-container ?>
    </div>   <?php // end div.main.wrapper ?>

     <?php $footer = apply_filters( 'cphsuborb_footer', '' ); ?>


      <div class="footer clr">
         <div class="container clr">

            <div class="table">
              <div class="tr">
                    <div class="td"><?php echo $footer; ?></div>
                    <div class="td">
                    
                    

                    
                    </div>
               </div>
            </div>
            
         </div>
      </div>

  <?php //endif; ?>

      <?php wp_footer();
	  
	 ?>

</body>
</html>