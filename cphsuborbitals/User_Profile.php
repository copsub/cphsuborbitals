<?php
/*
Template Name: Custom_Profiler
*/
?>
<?php get_header();?>

<?php 
//define('child_template_directory', dirname( get_bloginfo('stylesheet_url')) );
//load the function that updates the data
//echo (dirname( get_bloginfo('stylesheet_url')) . '/Profile/profile.php');
require_once ('Profile/profile.php');


//load the functions that upload and update the image
require_once ('Profile/profile_image.php');


//check if the user is logged in
if ( is_user_logged_in() ){
    //enter page to use to redirect
	$redirect = '?page_id=22'; //by id
	//$redirect = 'profile';  //by page slug

 //media_upload_library_form($e);
	//get current user information
	wp_get_current_user();
	$user_id = $current_user->ID;	
	$meta = get_user_meta($user_id, 'profile');
	$meta = $meta[0];
	$profile_image = get_user_meta($user_id, 'profile_image');
	$profile_image = $profile_image[0];
	
    //check if image upload button was pressed
	if ( isset( $_POST['html-upload'] ) && !empty( $_FILES ) ) {
      profile_image_upload($redirect,$user_id,$profile_image);
    }    
	//check if the submit button was pressed
	if (isset($_POST['submit'])) {
	   //email validation
	   if(is_email($_POST['USER']['user_email'])){
	   //if yes, call to update the data	     
	     update_data($user_id,$redirect);	
		 //if email is invalid, tell the user   
	   }else{$message .= 'Invalid%20Email:%20'.$_POST['USER']['user_email'];wp_redirect( home_url().$redirect.'&update='.$message );}

	 }

?>
	<h2>
	<?php if(!empty($_GET['update'])){ echo $_GET['update'];}//let the user know if data is updated ?>
    </h2>
    <h4>Welcome, <?php echo $current_user->display_name; ?></h4>
    <?php profile_image_display("medium",$profile_image); ?>
    <h2></h2>
    <!-- The Image Upload Form -->
    <ul id="image-upload">
    <form class="image-upload" id="file-form" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">  
        <li id="async-upload-wrap">  
        <label for="async-upload">Upload</label>  
        <input type="file" id="async-upload" name="async-upload"> <input type="submit" value="Upload" name="html-upload">  
        </li>  
        <!-- multiple file handling 
        <li id="async-upload-wrap">  
        <label for="async-upload">Upload</label>  
        <input type="file" id="async-upload" name="async-upload[]">   
        </li> 
         -->
        <li> 
        <!-- multiple file handling <input type="submit" value="Upload" name="html-upload"> -->
        <input type="hidden" name="post_id" id="post_id" value="1199" />  
        <?php wp_nonce_field('client-file-upload'); ?>  
        <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />  
        </li>   
    </form>
    </ul>
    <!-- End image upload form -->
    
	<!-- The Web Form with user data filled in if any exists -->
    <ul id="stylized">
	<form class="profileform" method="post" action="">       
		
        <li><label for="first_name">First Name </label><input type="text" name="USER[first_name]" value="<?php if(!empty($current_user->user_firstname)){ echo $current_user->user_firstname;} ?>" /></li>
		<li><label for="last_name">Last Name </label><input type="text" name="USER[last_name]" value="<?php if(!empty($current_user->user_lastname)){ echo $current_user->user_lastname;} ?>" /></li>
        <li><label for="user_email">Email </label><input type="text" name="USER[user_email]" value="<?php if(!empty($current_user->user_email)){ echo $current_user->user_email;} ?>" /></li>
        <li><label for="user_pass">Password </label><input type="password" name="USER[user_pass]" value="" /></li>
		
        <li><label for="gender">Gender</label>
		<select name="META[gender]">
		  <option <?php if($meta['gender']=='Neutral'){echo 'selected';} ?> value="Neutral">Neutral</option>
		  <option <?php if($meta['gender']=='Male'){echo 'selected';} ?> value="Male">Male</option>
		  <option <?php if($meta['gender']=='Female'){echo 'selected';} ?> value="Female">Female</option>
		</select><li>
		<li><label for="occupation">Occupation</label><input type="text" name="META[occupation]" value="<?php  if(!empty($meta['occupation'])){ echo $meta['occupation'];}  ?>" /></li>
		<li><label>&nbsp;</label><input type="submit" value="Update Profile" name="submit"/></li>
        
	</form>
    </ul>
   <!-- WEB FORM END -->
   
   
 <div style="height:100px;"></div>  
<?php 
} //end if user logged in

//Else user is not logged in
else { 

 //we give a message telling the user the 'WHY' and the 'HOW'
  echo '<h4>You must be logged in to view this page. </h4>';
  ?>
  <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>

<?php }   //end else ?>
<?php get_footer(); ?>
