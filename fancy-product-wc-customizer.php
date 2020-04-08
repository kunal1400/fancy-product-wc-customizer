<?php
/*
Plugin Name: fancy-product-wc-customizer
Plugin URI: https://www.paidmembershipspro.com/wp/pmpro-customizations/
Description: Customizations for my Paid Memberships Pro Setup
Version: .1
Author: Kunal Malviya
*/

/**
 * @snippet       Add First & Last Name to My Account Register Form - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WC 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
///////////////////////////////
// 1. ADD FIELDS
  
// add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );
  
function bbloomer_add_name_woo_account_registration() {
    ?>
  
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
  
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
  
    <div class="clear"></div>
  
    <?php
}
  
///////////////////////////////
// 2. VALIDATE FIELDS
  
// add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
  
function bbloomer_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}
  
///////////////////////////////
// 3. SAVE FIELDS

// https://stackoverflow.com/questions/51389308/fill-checkout-fields-values-from-url-variables-in-woocommerce
add_action( 'woocommerce_checkout_get_value', 'bbloomer_save_name_fields', 20, 2 );
  
function bbloomer_save_name_fields( $value, $imput ) {

    // Billing first name
    if(isset($_GET['firstname']) && ! empty($_GET['firstname']) && $imput == 'billing_first_name' )
        $value = esc_attr( $_GET['firstname'] );

    // Billing last name
    if(isset($_GET['lastname']) && ! empty($_GET['lastname']) && $imput == 'billing_last_name' )
        $value = esc_attr( $_GET['lastname'] );

    // Billing email
    if(isset($_GET['useremail']) && ! empty($_GET['useremail']) && $imput == 'billing_email' )
        $value = sanitize_email( $_GET['useremail'] );

    return $value; 
}