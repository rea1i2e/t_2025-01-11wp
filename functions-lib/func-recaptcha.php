<?php
/**
 * reCAPTCHAの表示制御
*/
function google_recaptcha_v3() {
  if (!is_page(
    ['contact', 'contact-confirm', 'contact-thanks']
  )) {
    wp_deregister_script('google-recaptcha');
  }
}
add_action('wp_enqueue_scripts', 'google_recaptcha_v3', 99);
