jQuery(document).ready(function($) {
    if ($('body[class*=" rp_"]').length || $('body[class*=" post-type-rp_"]').length) {

        $rp_menu_li = $('#toplevel_page_rp_dashboard_admin_page');

        $rp_menu_li
            .removeClass('wp-not-current-submenu')
            .addClass('wp-has-current-submenu')
            .addClass('wp-menu-open');

        $('a:first', $rp_menu_li)
            .removeClass('wp-not-current-submenu')
            .addClass('wp-has-submenu')
            .addClass('wp-has-current-submenu')
            .addClass('wp-menu-open');
    }
});