<?php

class BWFAN_WC_Cart_Currency extends BWFAN_Merge_Tag {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'cart_currency';
		$this->tag_description = __( 'Cart Currency (Symbol)', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_cart_currency', array( $this, 'parse_shortcode' ) );
		$this->support_fallback = false;
		$this->priority         = 5.2;
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
	 * @return mixed|void
	 */
	public function parse_shortcode( $attr ) {
		if ( true === BWFAN_Merge_Tag_Loader::get_data( 'is_preview' ) ) {
			return $this->get_dummy_preview();
		}

		$cart_details = BWFAN_Merge_Tag_Loader::get_data( 'cart_details' );

		if ( empty( $cart_details ) ) {
			$abandoned_id = BWFAN_Merge_Tag_Loader::get_data( 'cart_abandoned_id' );
			$cart_details = BWFAN_Model_Abandonedcarts::get( $abandoned_id );
		}

		if ( empty( $cart_details ) ) {
			return $this->parse_shortcode_output( '', $attr );
		}

		$field_value = strtoupper( $cart_details['currency'] );

		return $this->parse_shortcode_output( $field_value, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		return strtoupper( get_woocommerce_currency() );
	}


}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_ab_cart', 'BWFAN_WC_Cart_Currency', null, __( 'Abandoned Cart', 'wp-marketing-automations' ) );
}
