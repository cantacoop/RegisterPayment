<?php
function rp_save_payment() {

    // setup default result data
    $result = array(
        'status' => 0,
        'message' => 'Subscription was not saved.',
    );

    try {

        // Form validation
        $errors = array();
        $required_fields['rp_customer'] = 'Customer is required.';
        $required_fields['rp_phone']    = 'Phone is required.';
        $required_fields['rp_email']    = 'Email is required.';
        $required_fields['rp_invoice_number']    = 'Invoice is required.';
        $required_fields['rp_payment_amount']    = 'Amount is required.';
        $required_fields['rp_payment_journal']   = 'Journal is required.';
        $required_fields['rp_payment_date']      = 'Date is required.';

        foreach ($_POST as $key => $value) {
            if (array_key_exists($key, $required_fields)) {
                if (!strlen(esc_attr( $_POST[$key] ))) {
                    $errors[$key] = $required_fields[$key];
                }
            }
        }

        if (count($errors)) {
            $result['errors'] = $errors;
        }else {

            $customer      = esc_attr( $_POST['rp_customer'] );
            $phone         = esc_attr( $_POST['rp_phone'] );
            $email         = esc_attr( $_POST['rp_email'] );
            $invoice       = esc_attr( $_POST['rp_invoice_number'] );
            $amount        = esc_attr( $_POST['rp_payment_amount'] );
            $journal       = esc_attr( $_POST['rp_payment_journal'] );
            $payment_date  = esc_attr( $_POST['rp_payment_date'] );
            $payment_time  = esc_attr( $_POST['rp_payment_time'] );
            $memo          = esc_attr( $_POST['rp_memo'] );
            $title         = "#{$invoice} {$customer}";

            // prepare payment data 
            $payment_data = array(
                'post_type'     => 'rp_payment',
                'post_status'   => 'publish',
                'post_title'    => $title,
            );
            $payment_id = wp_insert_post( $payment_data, true );

            update_field( rp_get_acf_key('rp_customer'), $customer, $payment_id );
            update_field( rp_get_acf_key('rp_phone'), $phone, $payment_id );
            update_field( rp_get_acf_key('rp_email'), $email, $payment_id );
            update_field( rp_get_acf_key('rp_invoice_number'), $invoice, $payment_id );
            update_field( rp_get_acf_key('rp_payment_amount'), $amount, $payment_id );
            update_field( rp_get_acf_key('rp_payment_journal'), $journal, $payment_id );
            update_field( rp_get_acf_key('rp_payment_date'), $payment_date, $payment_id );
            update_field( rp_get_acf_key('rp_payment_time'), $payment_time, $payment_id );
            update_field( rp_get_acf_key('rp_memo'), $memo, $payment_id );
            update_field( rp_get_acf_key('rp_status'), 'Open', $payment_id );

            $result['status'] = 1;
            $result['message'] = 'Subscription saved';
        }

    } catch (Exception $e) {}

    // return result an json
    slb_return_json($result);
}
add_action( 'wp_ajax_nopriv_rp_save_payment', 'rp_save_payment' ); // regular website visitor
add_action( 'wp_ajax_rp_save_payment', 'rp_save_payment' ); // admin user

function rp_get_acf_key( $field_name ) {

    switch( $field_name ) {
        case 'rp_customer':
            return 'field_5a8d5f8a7034e';
        case 'rp_phone':
            return 'field_5a8d5fc27034f';
        case 'rp_email':
            return 'field_5a8d5fd170350';
        case 'rp_invoice_number':
            return 'field_5a8d573749bc7';
        case 'rp_payment_amount':
            return 'field_5a8d5299e1f22';
        case 'rp_payment_journal':
            return 'field_5a8d52dee1f23';
        case 'rp_payment_date':
            return 'field_5a8d537ae1f24';
        case 'rp_payment_time':
            return 'field_5a8d53c9e1f25';
        case 'rp_memo':
            return 'field_5a8d540fe1f26';
        case 'rp_status':
            return 'field_5a8d6e5811a9e';
    }
}
