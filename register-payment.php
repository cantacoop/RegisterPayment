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

function rp_payment_column_header( $columns ) {

    unset($columns['date']);
    $columns['title']   = __('Order');
    $columns['status']  = __('Status');
    $columns['total']   = __('Total');
    $columns['paid_on']    = __('Pain on');

    return $columns;
}
add_filter( "manage_edit-rp_payment_columns", "rp_payment_column_header" );

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

function sp_register_custom_admin_titles() {
    add_filter( 'the_title', 'sp_custom_admin_titles', 99, 2 );
}
add_action( 'admin_head-edit.php', 'sp_register_custom_admin_titles' );

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