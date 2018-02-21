<?php
function rp_form_shortcode( $args ) {

    return
'<div class="container-fluid">
    <div class="row">
        <form>
            <fieldset>
                <legend>Register Payment</legend>
                <p class="form-group">
                    <label for="rp_customer">Customer</label>
                    <input type="text" name="rp_customer" id="rp_customer" placeholder="John Doe">
                </p>
                <p class="form-group">
                    <label for="rp_phone">Phone</label>
                    <input type="text" name="rp_phone" id="rp_phone" placeholder="081-2345678">
                </p>
                <p class="form-group">
                    <label for="rp_email">Email</label>
                    <input type="text" name="rp_email" id="rp_email" placeholder="john@example.com">
                </p>
                <p class="form-group">
                    <label for="rp_invoice">Invoice Number</label>
                    <input type="text" name="rp_invoice" id="rp_invoice" placeholder="INV/2018/0001">
                </p>
                <p class="form-group">
                    <label for="rp_amount">Payment Amount</label>
                    <input type="text" name="rp_amount" id="rp_amount" placeholder="0.00">
                </p>
                <p class="form-group">
                    <label for="rp_journal">Payment Journal</label>
                    <select id="rp_journal">
                        <option value="cash">Cash</option>
                        <option value="kbank">Kasikorn Bank</option>
                        <option value="bbl">Bangkok Bank</option>
                    </select>
                </p>
                <p class="form-group">
                    <label for="rp_date">Payment Date</label>
                    <input type="date" name="rp_date" id="rp_date">
                </p>
                <p class="form-group">
                    <label for="rp_time">Payment Time</label>
                    <input type="time" name="rp_time" id="rp_time">
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

}