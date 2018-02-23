<?php
function rp_form_shortcode( $args ) {
    $args = array(
        'numberposts' => -1,
        'post_type'   => 'rp_journal'
    );
    
    // get list journal
    $journals = get_posts( $args );
    $options = '';
    foreach ($journals as $journal) {
        setup_postdata( $journal );
        $options .= '<option value="'.$journal->ID.'">'. $journal->post_title .'</option>';
    }

    // form register payment
    $output =
'<div class="container-fluid">
    <div class="row">
        <form method="post"
        action="/wp-admin/admin-ajax.php?action=rp_save_payment">
            <fieldset>
                <legend>Register Payment</legend>
                <p class="form-group">
                    <label for="rp_customer">Customer <span style="color:red">*</span></label>
                    <input type="text" name="rp_customer" id="rp_customer" placeholder="John Doe">
                </p>
                <p class="form-group">
                    <label for="rp_phone">Phone <span style="color:red">*</span></label>
                    <input type="text" name="rp_phone" id="rp_phone" placeholder="081-2345678">
                </p>
                <p class="form-group">
                    <label for="rp_email">Email <span style="color:red">*</span></label>
                    <input type="text" name="rp_email" id="rp_email" placeholder="john@example.com">
                </p>
                <p class="form-group">
                    <label for="rp_invoice_number">Invoice Number <span style="color:red">*</span></label>
                    <input type="text" name="rp_invoice_number" id="rp_invoice_number" placeholder="INV/2018/0001">
                </p>
                <p class="form-group">
                    <label for="rp_payment_amount">Payment Amount <span style="color:red">*</span></label>
                    <input type="text" name="rp_payment_amount" id="rp_payment_amount" placeholder="0.00">
                </p>
                <p class="form-group">
                    <label for="rp_payment_journal">Payment Journal <span style="color:red">*</span></label>
                    <select name="rp_payment_journal" id="rp_payment_journal">'.$options;

                    $output .= '</select>
                </p>
                <p class="form-group">
                    <label for="rp_payment_date">Payment Date <span style="color:red">*</span></label>
                    <input type="date" name="rp_payment_date" id="rp_payment_date">
                </p>
                <p class="form-group">
                    <label for="rp_payment_time">Payment Time</label>
                    <input type="time" name="rp_payment_time" id="rp_payment_time">
                </p>
                <p class="form-group">
                    <label for="rp_memo">Memo</label>
                    <textarea name="rp_memo" id="rp_memo" rows="3"></textarea>
                </p>
                <p>
                    <input type="submit" value="Validate">
                </p>
            </fieldset>
        </form>
    </div>
</div>
';

    return $output;

}