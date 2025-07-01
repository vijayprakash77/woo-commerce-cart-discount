<?php
/*
Plugin Name: WooCommerce Conditional Discount
Plugin URI: https://test.com/
Description: Applies 15% automatic discount when cart contains Accessories category products and total cart value is ₹2000 or more than this.
Version: 0.0.1
Requires PHP: 5.6.20
Author: Vijay Prakash Mahato
Author URI: https://test.com
Text Domain: WooCommerce Conditional Discount
*/

if (!defined('ABSPATH')) {
    exit;
}

define('WCD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WCD_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WCD_VERSION', '1.0.0');

function wcd_init_plugin() {

    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', 'wcd_woocommerce_missing_notice');
        return;
    }

     wcd_load_hooks();
}

add_action('plugins_loaded', 'wcd_init_plugin');

function wcd_woocommerce_missing_notice() {
    
    echo '<div class="error"><p><strong>WooCommerce Conditional Discount</strong> requires WooCommerce to be installed and active.</p></div>';
}

function wcd_load_hooks() {

    add_action('woocommerce_cart_calculate_fees', 'wcd_apply_conditional_discount');
    add_filter('render_block_woocommerce/cart', 'add_custom_message_before_cart', 10, 3);
    add_action('wp_enqueue_scripts', 'wcd_add_custom_enqueue_frontend_styles');
}

function wcd_apply_conditional_discount() {

    if (WC()->cart->is_empty()) {
        return;
    }
    
    $cart_items = WC()->cart->get_cart();
    $cart_total = WC()->cart->get_subtotal();
    
    if ($cart_total < 2000) {
        return;
    }
    
    $has_accessories = false;
    
    $accessories_slugs = array(
        'accessories'
    );
    
    foreach ($cart_items as $cart_item) {

        $product_id = $cart_item['product_id'];
        
        $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'slugs'));
        
        foreach ($product_categories as $category_slug) {
            if (in_array(strtolower($category_slug), $accessories_slugs)) {
                $has_accessories = true;
                break 2;
            }
        }
    }
    
    if ($has_accessories) {

        $discount_amount = $cart_total * 0.15;
        
        WC()->cart->add_fee(
            __('Accessories Discount (15%)', 'woo-conditional-discount'),
            -$discount_amount
        );
    }
}

function add_custom_message_before_cart($block_content, $block, $instance) {

            if (!is_cart()) {
                return;
            }
            
            if (WC()->cart->is_empty()) {
                return;
            }
            
            $cart_items = WC()->cart->get_cart();
            $cart_total = WC()->cart->get_subtotal();
            
            $cart_meets_minimum = ($cart_total >= 2000);
            $has_accessories = false;
            $accessories_slugs = array('accessories');
            
            foreach ($cart_items as $cart_item) {

                $product_id = $cart_item['product_id'];
                $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'slugs'));
                
                foreach ($product_categories as $category_slug) {
                    if (in_array(strtolower($category_slug), $accessories_slugs)) {
                        $has_accessories = true;
                        break 2;
                    }
                }
            }
            $discount_message="";

            if ($cart_meets_minimum && $has_accessories) {
                $discount_amount = $cart_total * 0.15;
                
            $discount_message.='<div class="wcd-discount-message">';
            $discount_message.= '<p><strong>' . __("You've received a 15% Accessories Discount!", 'woo-conditional-discount') . '</strong></p>';
            $discount_message.= '<p>' . sprintf(__('Discount Amount: ₹%.2f', 'woo-conditional-discount'), $discount_amount) . '</p>';
            $discount_message.= '</div>';

            }
            return $discount_message . $block_content;
}

function wcd_add_custom_enqueue_frontend_styles() {
	
        wp_enqueue_style(
            'woo-conditional-discount-frontend',
            WCD_PLUGIN_URL . 'assests/css/frontend.css',
            array(),
            WCD_VERSION
        );
}

function wcd_deactivate_plugin() {

    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'wcd_deactivate_plugin');

?>