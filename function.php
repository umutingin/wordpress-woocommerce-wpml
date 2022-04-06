<?php
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
/////////////////////////          WORDPRESS          ////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

//Admin Panel Footer Text
function custom_admin_footer() {
	echo 'Custom Text';
}

//Remove Wordpress Version
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');

//Remove Welcome Widget Panel
remove_action('welcome_panel', 'wp_welcome_panel');

//Custom Login Page
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//Login Page Style
add_filter('admin_footer_text', 'custom_admin_footer');
function custom_loginlogo() {
	echo '<style type="text/css"> 
	body {
		background: #f6f6f6;
	}
	.login h1 a {
		background-size: 250px;
		width: 250px;
		height: 150px;
	}
	body.login div#login h1 a {
		background-image: url(yourlogo.png);
	}
	.login form {
		border-radius: 10px;
		-webkit-box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.5);
		-moz-box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.5);
		box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.5);
	}
	.login input[type=text], .login input[type="password"], input[type=checkbox] {
		border: 2px solid #e6e6e6 !important;
		border-radius: 5px !important;
	}
	.login input[type=text]:focus, .login input[type="password"]:focus, .login input[type="checkbox"]:focus {
		border: 2px solid #333333 !important;
		box-shadow: 0 0 2px rgba(255, 255, 255, 0.8);
	}
	.login input[type="checkbox"] {
		margin-bottom: -2px;
	}
	.login input[type="checkbox"]:checked::before {
		color: #595959 !important;
		border-color: #595959 !important;
		margin: -4px 0 0 -5px;
	}
	.login .forgetmenot {
		padding-top: 4px;
	}
	.login .button-primary {
		background: #fff;
		border: 2px solid;
		border-color: #333333;
		box-shadow: none;
		color: #333333;
		text-decoration: none;
		text-shadow: none;
		font-weight: 500;
	}
	#login #login-error a {
		color: 595959;
		text-decoration: none !important;
	}
	#login #login-error a:hover {
		color: 595959;
		text-decoration: none !important;
	}
	#login #login-error a:focus {
		box-shadow: 0 0 0 1px #595959, 0 0 2px 1px rgba(89,89,89,.8) !important;
	}
	.wp-core-ui .button-primary:hover {
		background: #595959 !important;
		border-color: #595959 !important;
		-webkit-transition: color 150ms linear, background-color 300ms ease-in, border-color 175ms linear;
		-moz-transition: color 150ms linear, background-color 300ms ease-in, border-color 175ms linear;
		-ms-transition: color 150ms linear, background-color 300ms ease-in, border-color 175ms linear;
		-o-transition: color 150ms linear, background-color 300ms ease-in, border-color 175ms linear;	
		transition: color 150ms linear, background-color 300ms ease-in, border-color 175ms linear;	
	}
	.wp-core-ui .button-primary:active {
		background: #595959 !important;
		border-color: #595959 !important;
		box-shadow: none !important;
	}
	.wp-core-ui .button-primary:visited {
		background: #595959 !important;
		border-color: #595959 !important;
		box-shadow: none !important;
	}
	.wp-core-ui .button-primary:focus {
		background: #595959 !important;
		border-color: #595959 !important;
		box-shadow: none !important;
	}
	.wp-core-ui .button-primary:focus-within {
		background: #595959 !important;
		border-color: #595959 !important;
		box-shadow: none !important;
	}
	.wp-core-ui .button.button-large {
		line-height: 26px !important;
		padding: 0px 20px 0px;
	}
	.login #loginform .submit, .login #loginform .submit input {
		outline: none !important;
	}
	.login #nav, .login #backtoblog {
		text-align: center;
	}
	.login #nav a:hover, .login #backtoblog a:hover {
		color: #595959;
	}
	.login #nav a:focus, .login #backtoblog a:focus {
		box-shadow: 0 0 0 1px #595959, 0 0 2px 1px rgba(89,89,89,.8);
	}
	.login .privacy-policy-page-link a {
		color: #595959;
		text-decoration: none;
	}
	.login .privacy-policy-page-link a:hover {
		color: #595959;
		text-decoration: none;
	}
	.login #backtoblog {
		margin: 5em 0 2em;
		font-size: 14px;
	}
	.login .privacy-policy-page-link {
		margin: 0px;
		font-size: 12px;
	}
	</style>';
}
add_action('login_head', 'custom_loginlogo');

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
/////////////////////          WOOCOMMERCE - WPML          ///////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

//Hide Price and Add-To-Cart Button For Guests
function woocommerce_template_loop_price() {
    if ( is_user_logged_in() )
        woocommerce_get_template( 'loop/price.php' );
}
function woocommerce_template_loop_add_to_cart() {
    if ( is_user_logged_in() )
        woocommerce_get_template( 'loop/add-to-cart.php' );
}
function woocommerce_template_single_price() {
    if ( is_user_logged_in() )
        woocommerce_get_template( 'single-product/price.php' );
}
function woocommerce_template_single_add_to_cart() {
    global $product;
    if ( is_user_logged_in() )
        do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
}

//Log In Redirect Shop Page
add_filter('woocommerce_login_redirect', 'wc_login_redirect');
function wc_login_redirect( $redirect_to ) {
    if(ICL_LANGUAGE_CODE=='tr'){
    	$redirect_to = 'http://yourwebsite.com/tr/shop';
     	return $redirect_to;
    }
	else {
		$redirect_to = 'http://yourwebsite.com/en/shop';
     	return $redirect_to;
	}
}

//Log Out Redirect Home Page
function iconic_bypass_logout_confirmation() {
    global $wp;
    if ( isset( $wp->query_vars['customer-logout'] ) ) {
        if(ICL_LANGUAGE_CODE=='tr'){
			wp_redirect( str_replace( '&amp;', '&', wp_logout_url( wc_get_page_permalink( 'http://yourwebsite.com/tr/' ) ) ) );
			exit;
    	}
		else {
			wp_redirect( str_replace( '&amp;', '&', wp_logout_url( wc_get_page_permalink( 'http://yourwebsite.com/en/' ) ) ) );
			exit;
		}
    }
}
add_action( 'template_redirect', 'iconic_bypass_logout_confirmation' );

//Hide Shop Page For Guests (en)
function custom_redirect_shop_en() {
    if ( ! is_user_logged_in() && 'en' == ICL_LANGUAGE_CODE && ( is_woocommerce() || is_shop() || is_product() || is_product_category() || is_cart() || is_checkout() ) ) {
		wp_redirect( site_url( '/en/my-account/' ) );
		exit();
    }
}
add_action('template_redirect', 'custom_redirect_shop_en');

//Hide Shop Page For Guests (tr)
function custom_redirect_shop_tr() {
    if ( ! is_user_logged_in() && 'tr' == ICL_LANGUAGE_CODE && ( is_woocommerce() || is_shop() || is_product() || is_product_category() || is_cart() || is_checkout() ) ) {
		wp_redirect( site_url( '/tr/my-account/' ) );
		exit();
    }
}
add_action('template_redirect', 'custom_redirect_shop_tr');

//Add Password Repeat Field
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		if(ICL_LANGUAGE_CODE == 'tr') {
			return new WP_Error( 'registration-error', __( 'Şifreler eşleşmedi.', 'woocommerce' ) );
    	} 
		else {
			return new WP_Error( 'registration-error', __( 'Passwords not to match.', 'woocommerce' ) );
		}
	}
	return $reg_errors;
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {	
	if(ICL_LANGUAGE_CODE == 'tr') {
		?>
		<p class="form-row form-row-wide">
			<label for="reg_password2"><?php _e( 'Şifre Tekrar', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
		</p>
		<?php
    } 
    else {
		?>
		<p class="form-row form-row-wide">
			<label for="reg_password2"><?php _e( 'Password Repeat', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
		</p>
		<?php
    }	
}

//Remove Related Products (Single Product Page)
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

//Remove The Additional Information Tab
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

//Remove Register Button (wp-login Page)
function hide_login_links_div() {
	echo '<style type="text/css">
		.login #nav {
			display: none;
			}
		 </style>';
	}
add_action('login_head', 'hide_login_links_div');

//Shipping Country by Language
function change_default_checkout_country_en() {
    if(ICL_LANGUAGE_CODE=='en'){
        return 'US';
    }
}
add_filter( 'default_checkout_country', 'change_default_checkout_country_en' );

function change_default_checkout_country_tr() {
    if(ICL_LANGUAGE_CODE=='tr'){
        return 'TR';
    }
}
add_filter( 'default_checkout_country', 'change_default_checkout_country_tr' );

function woo_override_checkout_fields_billing( $fields ) { 
    if(ICL_LANGUAGE_CODE=='tr'){
    $fields['billing']['billing_country'] = array(
        'type'      => 'select',
        'label'     => __('Ülke', 'woocommerce'),
        'options'   => array('TR' => 'Turkey')
    );
    }
    elseif (ICL_LANGUAGE_CODE=='en'){
        $fields['billing']['billing_country'] = array(
            'type'      => 'select',
            'label'     => __('Country', 'woocommerce'),
            'options'   => array('US' => 'United States')
        ); 
    }
    return $fields;
} 
add_filter( 'woocommerce_checkout_fields' , 'woo_override_checkout_fields_billing' );

//Hide Shipping Rates When Free Shipping Is Available
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );
