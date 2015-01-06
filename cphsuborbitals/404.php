<?php get_header(); ?>

<div class="main-area">

        <article>
          <div class="entry-content">
          
       <?php 
		   get_template_part( 'content', get_post_format() ); 
       ?>       
             
          </div>
        </article>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>