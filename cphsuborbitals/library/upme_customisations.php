<?php

function upme_profile_after_fields($content,$user_id){
  $current_user = get_user_by( 'id', $user_id );
  $args = array(
              'numberposts'     => '-1',
              'post_type'       => 'dgx-donation',
              'meta_key'        => '_dgx_donate_donor_email',
              'meta_value'      =>  $current_user->user_email,
              'order'           => 'ASC'
      );
  $my_donations = get_posts( $args );

  $content = "<div class='upme-main'>";
  $content .= "<div class='upme-clear'></div>";
  $content .= "<div class='upme-field upme-view' style='display: block;'>
                                  <div class='upme-field-type'><i class='upme-icon-rocket'></i><span>Your Donations</span></div>
                                  <div class='upme-field-value'>
                                    <table class='upme-donations-table' style='width:100%'>
                                      <tr><th>Date</th><th>Amount</th><th>Transaction ID</th></tr>";

  $total_last_year = 0;
  foreach ( (array) $my_donations as $my_donation ) {
    $donation_id = $my_donation->ID;

    $year = get_post_meta( $donation_id, '_dgx_donate_year', true );
    $month = get_post_meta( $donation_id, '_dgx_donate_month', true );
    $day = get_post_meta( $donation_id, '_dgx_donate_day', true );
    $time = get_post_meta( $donation_id, '_dgx_donate_time', true );
    $transaction_id = get_post_meta( $donation_id, '_dgx_donate_transaction_id', true );
    $amount = get_post_meta( $donation_id, '_dgx_donate_amount', true );
    $currency_code = dgx_donate_get_donation_currency_code( $donation_id );
    $formatted_amount = dgx_donate_get_escaped_formatted_amount( $amount, 2, $currency_code );

    $content .= "<tr><td>" . esc_html( $year . "-" . $month . "-" . $day . " " . $time ) . "</td>";
    $content .= "<td>" . $formatted_amount . "</td>";
    $content .= "<td>" . $transaction_id . "</td>";
    $content .= "</tr>$donation_id\n";


    if (strtotime($my_donation->post_date) > strtotime('-365 days')){
      $total_last_year += $amount;
    }
  };


  $content .= "</table><p>Total donations during last year: $total_last_year</p></div></div></div>";

  if (sizeof($my_donations) > 0 && current_user_can( 'manage_options' )){
    return $content;
  }else{
    return "";
  }

}

add_filter('upme_full_profile_after_fields','upme_profile_after_fields',10,2);

?>