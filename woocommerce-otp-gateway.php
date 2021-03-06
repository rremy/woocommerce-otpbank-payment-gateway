<?php
/*
 * Plugin Name: Woocommerce Payment Gateway for OTP
 * Plugin URI:  http://www.wooh.hu/
 * Description: Adds OTP Payment Gateway to Woocommerce e-commerce plugin
 * Author:      Adam Papai
 * Author URI:  http://www.wooh.hu
 * Version:     1.1.1
 * Text Domain: woocommerce-otpbank
 * Domain Path: /languages/
 * License:     GPLv2
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

add_action('plugins_loaded', 'init_wooh_otpbank', 0);

function init_wooh_otpbank() {

    if ((!class_exists('WC_Payment_Gateway'))) {
        return;
    }

    include_once "woocommerce-otp.php";

    add_filter('woocommerce_payment_gateways', 'wooh_add_otpbank_gateway');
    function wooh_add_otpbank_gateway( $methods ) {
        $methods[] = 'WC_Gateway_OTPBank';
        return $methods;
    }
}

// Add custom action links
add_filter('plugin_action_links_' . plugin_basename( __FILE__ ),'wooh_otpbank_action_links');

function wooh_otpbank_action_links($links) {
    $plugin_links = array('<a href="'.admin_url('admin.php?page=wc-settings&tab=checkout').'">'.__('Settings', 'otpbank').'</a>',);
    return array_merge($plugin_links,$links);
}

?>
