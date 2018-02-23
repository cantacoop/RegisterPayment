<?php
function rp_register_rp_payment() {

	/**
	 * Post Type: Payments.
	 */

	$labels = array(
		"name" => __( "Payments", "twentyseventeen" ),
		"singular_name" => __( "Payment", "twentyseventeen" ),
	);

	$args = array(
		"label" => __( "Payments", "twentyseventeen" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "rp_payment", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-carrot",
		"supports" => false,
	);

	register_post_type( "rp_payment", $args );

	/**
	 * Post Type: Journals.
	 */

	$labels = array(
		"name" => __( "Journals", "twentyseventeen" ),
		"singular_name" => __( "Journal", "twentyseventeen" ),
	);

	$args = array(
		"label" => __( "Journals", "twentyseventeen" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "rp_journal", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-clipboard",
		"supports" => array( "title" ),
	);

	register_post_type( "rp_journal", $args );
}
add_action( 'init', 'rp_register_rp_payment' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_payment-details',
		'title' => 'Payment Details',
		'fields' => array (
			array (
				'key' => 'field_5a8d5f8a7034e',
				'label' => 'Customer',
				'name' => 'rp_customer',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a8d5fc27034f',
				'label' => 'Phone',
				'name' => 'rp_phone',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a8d5fd170350',
				'label' => 'Email',
				'name' => 'rp_email',
				'type' => 'email',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_5a8d573749bc7',
				'label' => 'Invoice Number',
				'name' => 'rp_invoice_number',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a8d5299e1f22',
				'label' => 'Payment Amount',
				'name' => 'rp_payment_amount',
				'type' => 'number',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_5a8d52dee1f23',
				'label' => 'Payment Journal',
				'name' => 'rp_payment_journal',
				'type' => 'post_object',
				'required' => 1,
				'post_type' => array (
					0 => 'rp_journal',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a8d537ae1f24',
				'label' => 'Payment Date',
				'name' => 'rp_payment_date',
				'type' => 'date_picker',
				'required' => 1,
				'date_format' => 'yy-mm-dd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_5a8d53c9e1f25',
				'label' => 'Payment Time',
				'name' => 'rp_payment_time',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '--:--',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a8d540fe1f26',
				'label' => 'Memo',
				'name' => 'rp_memo',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 3,
				'formatting' => 'br',
			),
			array (
				'key' => 'field_5a8d6e5811a9e',
				'label' => 'Status',
				'name' => 'rp_status',
				'type' => 'select',
				'choices' => array (
					'Draft' => 'Draft',
					'Open' => 'Open',
					'Paid' => 'Paid',
				),
				'default_value' => 'Draft',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'rp_payment',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
