<?php

/**
 * Class BWFAN_WC_Cart_Shipping_First_Name
 *
 * Merge tag outputs cart shipping first name
 */
class BWFAN_WC_Cart_Shipping_First_Name extends Cart_Merge_Tag {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'cart_shipping_first_name';
		$this->tag_description = __( 'Cart Shipping First Name', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_cart_shipping_first_name', array( $this, 'parse_shortcode' ) );
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

		$cart_details = BWFAN_Merge_Tag_Loader::get_data( 'cart_details' );

		if ( empty( $cart_details ) ) {
			$abandoned_id = BWFAN_Merge_Tag_Loader::get_data( 'cart_abandoned_id' );
			$cart_details = BWFAN_Model_Abandonedcarts::get( $abandoned_id );
		}

		if ( empty( $cart_details ) ) {
			return $this->parse_shortcode_output( '', $attr );
		}

		$field_value = $this->get_cart_value( 'shipping_first_name', $cart_details );

		return $this->parse_shortcode_output( ucwords( $field_value ), $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		return 'John';
	}
}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_ab_cart', 'BWFAN_WC_Cart_Shipping_First_Name', null, __( 'Abandoned Cart', 'wp-marketing-automations' ) );
}
