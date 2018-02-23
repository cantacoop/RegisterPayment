<?php
//  register custom menu
function rp_admin_menus() {

    $top_menu_item = 'rp_dashboard_admin_page';

    add_menu_page('', 'Register Payment', 'manage_options', 'rp_dashboard_admin_page',
        'rp_dashboard_admin_page', 'dashicons-clipboard');

    // dashboard
    add_submenu_page( $top_menu_item, "", "Dashboard", "manage_options", $top_menu_item, $top_menu_item );

    // payment lists
    add_submenu_page( $top_menu_item, "", "Payments", "manage_options", "edit.php?post_type=rp_payment" );

    // journal lists
    add_submenu_page( $top_menu_item, "", "Journals", "manage_options", "edit.php?post_type=rp_journal" );
}
add_action( 'admin_menu', 'rp_admin_menus' );

// dashboard admin page
function rp_dashboard_admin_page() {

    $output = '
        <div class="wrap">
            <?php screen_icon(); ?>

            <h2>Register Payment</h2>

            <p>ปลัีกอิน แจ้งชำระเงิน สามารถเพิ่มฟอร์มง่ายๆ โดยการเพิ่มโค้ดย่อ [register_payment] เข้าไปในเพจ 
            สามารถเพิ่มรายการชำระเงิน และติดตามสถานะการชำระเงินของลูกค้าได้</p>
        </div>
    ';
        
    echo $output;
}