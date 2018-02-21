<?php
/*
Plugin Name:  Register Payment
Plugin URI:   https://github.com/cantacoop/RegisterPayment
Description:  Basic WordPress Plugin Register Payment
Version:      1.0.0
Author:       Cantacoop
Author URI:   https://www.linkedin.com/in/cantacoop/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  register-payment
*/

include_once(plugin_dir_path( __FILE__ ) . 'core/views/form.php');

function rp_register_shortcode() {
    add_shortcode( 'register_payment', "rp_form_shortcode" );
}
add_action( 'init', 'rp_register_shortcode' );