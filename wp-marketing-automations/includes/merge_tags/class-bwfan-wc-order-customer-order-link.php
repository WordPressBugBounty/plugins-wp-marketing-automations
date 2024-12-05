<?php

/**
 * Class BWFAN_WC_Order_Customer_Order_Link
 *
 * Merge tag outputs order customer order view link
 *
 * Since 2.0.6
 */
class BWFAN_WC_Order_Customer_Order_Link extends BWFAN_Merge_Tag {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'customer_order_view_link';
		$this->tag_description = __( 'Customer Order View Link', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_customer_order_view_link', array( $this, 'parse_shortcode' ) );
	}

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Parse the merge tag and return its value.
	 *
	 * @param $attr
	 *
	 * @return mixed|string|void
	 */
	public function parse_shortcode( $attr ) {
		if ( true === BWFAN_Merge_Tag_Loader::get_data( 'is_preview' ) ) {
			return $this->parse_shortcode_output( $this->get_dummy_preview(), $attr );
		}

		$order = BWFAN_Merge_Tag_Loader::get_data( 'wc_order' );
		if ( ! $order instanceof WC_Order ) {
			$order_id = BWFAN_Merge_Tag_Loader::get_data( 'order_id' );
			if ( intval( $order_id ) > 0 ) {
				$order = wc_get_order( $order_id );
			}
			if ( ! $order instanceof WC_Order ) {
				return $this->parse_shortcode_output( '', $attr );
			}
		}

		$order_view_url = $order->get_view_order_url();

		return $this->parse_shortcode_output( $order_view_url, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		return site_url();
	}
}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_order', 'BWFAN_WC_Order_Customer_Order_Link', null, __( 'Order', 'wp-marketing-automations' ) );
}
