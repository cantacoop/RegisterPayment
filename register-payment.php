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

// enable php debug mode
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include form
include_once(plugin_dir_path( __FILE__ ) . 'core/views/form.php');

// include post controller
include_once(plugin_dir_path( __FILE__ ) . 'core/controllers/post.php');

// include ACF
include_once( plugin_dir_path( __FILE__ ) . 'lib/advanced-custom-fields/acf.php');

// Advanced Custom Fields Settings
add_filter('acf/settings/path', 'rp_acf_settings_path');
add_filter('acf/settings/dir', 'rp_acf_settings_dir');
add_filter('acf/settings/show_admin', 'rp_acf_show_admin');
if (!defined('ACF_LITE')) {
    define('ACF_LITE', true); // turn off ACF plugin menu
}

// include Custom Field payment
include_once( plugin_dir_path( __FILE__ ) . 'cpt/rp_payment.php');

// include Custom Field journal
include_once( plugin_dir_path( __FILE__ ) . 'cpt/rp_journal.php');

// register ajax actions
add_action( 'wp_ajax_nopriv_rp_save_payment', 'rp_save_payment' ); // regular website visitor
add_action( 'wp_ajax_rp_save_payment', 'rp_save_payment' ); // admin user

// register shortcode
function rp_register_shortcode() {

    add_shortcode( 'register_payment', "rp_form_shortcode" );
}
add_action( 'init', 'rp_register_shortcode' );

// create column header
function rp_payment_column_header( $columns ) {

    unset($columns['date']);
    $columns['title']   = __('Order');
    $columns['status']  = __('Status');
    $columns['total']   = __('Total');
    $columns['paid_on'] = __('Pain on');

    return $columns;
}
add_filter( "manage_edit-rp_payment_columns", "rp_payment_column_header" );

// setup column header data
function rp_payment_column_data( $columns, $post_id ) {

    switch ( $columns ) {
        case 'status':
            $status = get_field('rp_status', $post_id);
            echo $status;
            break;
        case 'total':
            $total = get_field('rp_payment_amount', $post_id);
            echo number_format_i18n($total, 2);
            break;
        case 'paid_on':
            $date = get_field('rp_payment_date', $post_id);
            $time = get_field('rp_payment_time', $post_id);
            echo $date . ' ' . $time;
            break;
    }
}
add_filter( "manage_rp_payment_posts_custom_column", "rp_payment_column_data", 1, 2 );

// register title header column
function sp_register_custom_admin_titles() {
    add_filter( 'the_title', 'sp_custom_admin_titles', 99, 2 );
}
add_action( 'admin_head-edit.php', 'sp_register_custom_admin_titles' );

// edit datta title header column
function sp_custom_admin_titles( $title, $post_id ) {

    global $post;

    $output = $title;

    if ( isset( $post->post_type ) ) {
        switch( $post->post_type ) {
            case 'rp_payment': 
                $number     = get_field('rp_invoice_number', $post_id);
                $customer   = get_field('rp_customer', $post_id);
                $output     = "#{$number} {$customer}";
                break;
        }
    }

    return $output;
}

// loads external files into PUBLIC website
function rp_public_scripts() {

    // register scripts with WordPress's internal library
    wp_register_script( 'register-payment-js', 
        plugins_url( '/js/register-payment.js', __FILE__ ), 
        array('jquery'), 
        '', 
        true 
    );

    // add to que of scripts that get loaded into every page
    wp_enqueue_script( 'register-payment-js' );
}
// load external files to public website
add_action( 'wp_enqueue_scripts', 'rp_public_scripts');
