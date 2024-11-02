<?php

	add_action( 'wp_enqueue_scripts', 'ohio_child_local_enqueue_parent_styles' );

	function ohio_child_local_enqueue_parent_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	}


	function custom_pos_url($url)
{
   $url = site_url( '/pos/', 'https' );
   return $url;
}
add_filter('op_pos_url','custom_pos_url',10,1);


function op_custom_customer_field_google_address_data($session_response_data){
   
   
    $name_field =  array(
        'code' => 'name',
        'type' => 'text',
        'label' => __('Name','openpos'),
        'options'=> [],
        'placeholder' => __('Name','openpos'),
        'description' => '',
        'default' => '',
        'allow_shipping' => 'yes',
        'required' => 'no',
        'searchable' => 'no'
    );
    
      $phone_field = array(
        'code' => 'phone',
        'type' => 'text',
        'label' => __('Phone','openpos'),
        'options'=> array(),
        'placeholder' => __('Phone','openpos'),
        'description' => '',
        'default' => '',
        'allow_shipping' => 'yes',
        'required' => 'yes',
        'searchable' => 'yes'
      );
       
      $email_field = array(
        'code' => 'email',
        'type' => 'email',
        'label' => __('Email','openpos'),
        'options'=> array(),
        'placeholder' => __('Email','openpos'),
        'description' => '',
        'default' => '',
        'allow_shipping' => 'no',
        'required' => 'no',
        'searchable' => 'yes',
        'editable' => 'no'
      );
       $address_field = array(
         'code' => 'address',
         'type' => 'text',
         'label' => __('Address','openpos'),
         'options'=> array(),
         'placeholder' => __('Adress','openpos'),
         'description' => '',
         'default' => '',
         'allow_shipping'=> 'yes',
         'required' => 'no',
         'searchable' => 'no'
       );
        
      
    $addition_checkout_fields = array();
    
    $addition_checkout_fields[] = $address_field;
    
    $session_response_data['setting']['openpos_customer_fields'] = array($name_field,$phone_field);
    $session_response_data['setting']['openpos_customer_addition_fields'] = $addition_checkout_fields;

    return $session_response_data;
}
add_filter('op_get_login_cashdrawer_data','op_custom_customer_field_google_address_data',10,1);

function custom_pos_allow_receipt($session_response_data){
    $session_response_data['allow_receipt'] =  'yes';
    return $session_response_data;
}
add_filter('op_get_login_cashdrawer_data','custom_pos_allow_receipt',11,1);

function custom_pos_cart_subtotal_incl_tax($session_response_data){
    
    $session_response_data['setting']['pos_cart_subtotal_incl_tax'] = 'yes';
   return $session_response_data;

}
add_filter('op_get_login_cashdrawer_data','custom_pos_cart_subtotal_incl_tax',10,1);



add_filter('add_to_cart_redirect', 'cw_redirect_add_to_cart');
function cw_redirect_add_to_cart() {
   global $woocommerce;
   $cw_redirect_url_checkout = $woocommerce->cart->get_checkout_url();
   return $cw_redirect_url_checkout;
}

function custom_openpos_pos_header_js($handles){
    $handles[] = 'openpos.websql_handle';
    return $handles;
}

add_filter( 'openpos_pos_header_js', 'custom_openpos_pos_header_js' ,10 ,1);
add_action( 'init', 'custom_registerScripts' ,10 );
function custom_registerScripts(){
    wp_register_script( 'openpos.websql_handle', '' );
    wp_enqueue_script('openpos.websql_handle');
    wp_add_inline_script('openpos.websql_handle',"
        if(typeof global == 'undefined')
        {
             var global = global || window;
        }
        global.allow_websql = 'yes';
    ");
}

function rf_product_thumbnail_size( $size ) {
    global $product;

    $size = 'full';
    return $size;
}
add_filter( 'single_product_archive_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'subcategory_archive_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'woocommerce_gallery_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'woocommerce_gallery_image_size', 'rf_product_thumbnail_size' );

// Rest API

add_action('rest_api_init', 'register_rest_images' );
function register_rest_images(){
    register_rest_field( array('post'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
};