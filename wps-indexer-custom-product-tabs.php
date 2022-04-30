<?php
/**
 * Plugin Name: WPS Indexer Custom Product Tabs
 * Plugin URI: https://www.netpad.gr
 * Description: Adds Custom Product Tabs content in WPS index.
 * Version: 1.0.0
 * Author: geotsiokos
 * Author URI: https://www.netpad.gr
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'woocommerce_product_search_indexer_filter_content', 'custom_tabs_woocommerce_product_search_index', 10, 3 );
function custom_tabs_woocommerce_product_search_index( $content, $context, $post_id ) {
	if ( $context === 'post_content' ) {
		$product = wc_get_product( $post_id );
		$custom_tab_data = $product->get_meta( 'yikes_woo_products_tabs' );
		if ( is_array( $custom_tab_data ) && ! empty( $custom_tab_data ) ) {
			foreach ( $custom_tab_data as $tab ) {
				if ( !empty( $tab['content'] ) ) {
					$content .= ' ' . $tab['content'];
				}
			}
		}
	}
	return $content;
}

