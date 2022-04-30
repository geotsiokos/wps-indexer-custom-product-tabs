<?php
/**
 * Plugin Name: WPS Indexer Custom Product Tabs
 * Plugin URI: https://www.itthinx.com
 * Description: Adds Custom Product Tabs content in WPS index.
 * Version: 1.0.0
 * Author: itthinx
 * Author URI: https://www.itthinx.com
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
//add_action( 'init', 'test_custom_example_init' );
function test_custom_example_init(){
	$custom_tab_data = get_post_meta( 52, 'yikes_woo_products_tabs' , true );
	error_log( 'custom tab data ' );
	error_log( print_r( $custom_tab_data, true ) );
	if ( is_array( $custom_tab_data ) && ! empty( $custom_tab_data ) ) {
		foreach ( $custom_tab_data as $tab ) {
			if ( !empty( $tab['content'] ) ) { error_log( 'tab data ' . print_r( $tab['content'], true ) );
			$description = ' ' . $tab['content'];
			}
		}
	}
}

add_filter( 'woocommerce_product_search_indexer_filter_content', 'custom_tabs_woocommerce_product_search_index', 10, 3 );

function custom_tabs_woocommerce_product_search_index( $content, $context, $post_id ) {
	if ( $context === 'post_content' ) {
		$product = wc_get_product( $post_id );
		$custom_tab_data = $product->get_meta( 'yikes_woo_products_tabs' );
		//$custom_tab_data = get_post_meta( $post_id, 'yikes_woo_products_tabs' , true );
		//error_log( 'tab data ' . maybe_unserialize( $custom_tab_data ) );
		if ( is_array( $custom_tab_data ) && ! empty( $custom_tab_data ) ) {
			foreach ( $custom_tab_data as $tab ) {
				if ( !empty( $tab['content'] ) ) {
				$content .= ' ' . $tab['content'];
				}error_log( $content );
			}
			//$content .= ' ' . implode( '', $custom_tab_data );
		}
	}
	return $content;
}

