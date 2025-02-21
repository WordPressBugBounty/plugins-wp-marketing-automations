<?php

class BWFAN_WC_Cart_Abandoned_Id extends BWFAN_Merge_Tag {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'cart_abandoned_id';
		$this->tag_description = __( 'Cart Abandoned Id', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_cart_abandoned_id', array( $this, 'parse_shortcode' ) );
		$this->support_fallback = false;
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
	 * @return int|mixed|void
	 */
	public function parse_shortcode( $attr ) {
		if ( true === BWFAN_Merge_Tag_Loader::get_data( 'is_preview' ) ) {
			return $this->get_dummy_preview();
		}

		$id = BWFAN_Merge_Tag_Loader::get_data( 'cart_abandoned_id' );

		return $this->parse_shortcode_output( $id, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return integer
	 */
	public function get_dummy_preview() {
		return 11;
	}
}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_ab_cart', 'BWFAN_WC_Cart_Abandoned_Id', null, __( 'Abandoned Cart', 'wp-marketing-automations' ) );
}
