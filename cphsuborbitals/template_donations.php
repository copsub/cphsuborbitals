<?php
/*
Template Name: Donations Template
*/
?>

<?php get_header(); 

 global $post;


?>


<script>




</script>


<div class="main-area">
	<div class="wrapper_donate_section_1">
    <div class="main_donate_section_1_overlay_1 overlay_show">  
      <div style="font: 6.5em helvetica, sans-serif; font-weight: bold; color: #FFFFFF;padding:0px;margin:0px;">Donate</div>
    </div>
    <div class="main_donate_section_1_overlay_2 overlay_show">  
      <div style="font: 1.5vw helvetica, sans-serif; font-weight: bold; color: #FFFFFF;padding:0px;margin:0px;">How much would you like to give?</div>
    </div>
    <div class="main_donate_section_1_overlay_3 overlay_show">  
      <div style="font: 1.5vw helvetica, sans-serif; font-weight: normal; color: #ff4f00;padding:0px;margin:0px;"><label for="supporter">Make this a monthly donation</label></div>
    </div>
    <div class="main_donate_section_1_overlay_4 overlay_show">  
      <div style="font: 1.4vw helvetica, sans-serif; font-weight: normal; color: #FFFFFF;padding:0px;margin:0px;">
      Even though everyone in Copenhagen Suborbitals are working for free, we need earth money to build spaceships. Tools, rent and materials are not free. This is a 100 % crowdfunded project. we need you to get into space!
      </div>
    </div>
    <div class="main_donate_section_1_overlay_5 overlay_show">  
      <div style="font: 4.5vw helvetica, sans-serif; font-weight: normal; color: #FFFFFF;padding:0px;margin:0px;">Thanks</div>
    </div>
    <div class="main_donate_section_1_overlay_6 overlay_show">  
      <div style="font: 1.8vw helvetica, sans-serif; font-weight: normal; color: #ff4f00;padding:0px;margin:0px;">Now we're closer</div>
    </div>
	</div>

  <form action="" id="donationform">
    <div class="main_donate_section_1_overlay_7 overlay_show">  
      <div class="donate-button" id="paypal-donate" onclick="payWithPaypal();">
        <div style="font: 3vw helvetica, sans-serif; font-weight: bold;">Donate</div>
        <div style="font: 1.8vw helvetica, sans-serif; font-weight: normal;">via PayPal / Credit Card</div>
      </div>
    </div>    
    <div class="main_donate_section_1_overlay_8 overlay_show">  
      <div class="donate-button" id="bank-donate" onclick="jQuery('#bank-transfer-modal').show();">
        <div style="font: 3vw helvetica, sans-serif; font-weight: bold;">Donate</div>
        <div style="font: 1.8vw helvetica, sans-serif; font-weight: normal;">via Bank Transfer</div>
      </div>
    </div>    
    <div class="main_donate_section_1_overlay_9 overlay_show">  
      <input type="checkbox" id="supporter" name="supporter" value="supporter" style="margin-top:44%;margin-left:30%">
    </div>
    <div class="main_donate_section_1_overlay_10 overlay_show"> 
      <input type="text" name="a3" id="amount-field" value="" style="">
    </div>
    <div class="main_donate_section_1_overlay_11 overlay_show"> 
      <select name="currency_code" id="currency_code">
        <option value="USD">USD</option>
        <option value="DKK">DKK</option>
        <option value="EUR">EURO</option>
      </select>
    </div>
  </form>

  <div class="main_donate_section_1_overlay_12 overlay_show"> 
    <div style="width:100%;background:url('http://copenhagensuborbitals.com/ext/fbtab/dividerline.png') no-repeat;height:1px; "></div>
  </div>
  <div class="main_donate_section_1_overlay_13 overlay_show"> 
    <div style="width:100%;background:url('http://copenhagensuborbitals.com/ext/fbtab/dividerline.png') no-repeat;height:1px; "></div>
  </div>



    <div id="bank-transfer-modal">
    <a href="#" id="close" onclick="jQuery('#bank-transfer-modal').hide()">X</a>
    <form action="#" id="bank-transfer-modal-content" onsubmit="payWithBankTransfer()">
      <p>
        Please enter your email address so we can send you the donation instructions:
      </p>
      <input style="width: 80%" id="bank-transfer-email" type="text" name="email"/>
      <a class="button" href="#" onclick="payWithBankTransfer()">Send</a>
    </form>
  </div>

  <!-- Replace with https://www.sandbox.paypal.com/cgi-bin/webscr for testing in the sandbox. Remember to change also the settings in dgx-donate-paypalstd.php -->
  <form id="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" id="encrypted-field" name="encrypted" value="">
    <input type="submit" value="Donate">
  </form>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

