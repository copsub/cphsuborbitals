jQuery.get("http://ipinfo.io", function (response) {
  if (response.country == "DK") {
  jQuery("#currency_code").val("DKK");
  }
  if (response.country == "DE") {
  jQuery("#currency_code").val("EURO");
  } 
  if (response.country == "SE") {
  jQuery("#currency_code").val("EURO");
  }
  if (response.country == "NO") {
  jQuery("#currency_code").val("EURO");
  } 
  if (response.country == "ES") {
  jQuery("#currency_code").val("EURO");
  }
  if (response.country == "US") {
  jQuery("#currency_code").val("USD");
  } 
}, "jsonp");


function payWithBankTransferCallback(data){
  jQuery('#bank-transfer-modal-content').html('<h1>Thank you for your donation!<br/></h1><h3>Please check your email.</h3>');
}


function payWithBankTransfer(){
  if (jQuery('#amount-field').val() == ''){
    alert('Please enter an amount');
    return;
  }
  var data = { action: 'dgx_donate_bank_transfer', email: jQuery('#bank-transfer-email').val(), amount: jQuery('#amount-field').val(), currency: jQuery('#currency_code').val(), monthly: jQuery('#supporter').is(":checked") };
  jQuery.post( '/wp-admin/admin-ajax.php', data, payWithBankTransferCallback );
  jQuery('#bank-transfer-modal-content').html('<h3>Loading...</h3>');
  return false;
}

function payWithPaypalCallback(data){
  // Copy the encrypted string into the form field
  jQuery('#encrypted-field').val(data);

  // Submit the form to Paypal
  jQuery('#paypal-form').submit();
}

function payWithPaypal(){
  if (jQuery('#amount-field').val() == ''){
    alert('Please enter an amount');
    return;
  }
  var data = { action: 'dgx_donate_paypal', amount: jQuery('#amount-field').val(), currency: jQuery('#currency_code').val(), monthly: jQuery('#supporter').is(":checked") };
  jQuery.post( '/wp-admin/admin-ajax.php', data, payWithPaypalCallback );
  return false;
}
