<?php

class BWFAN_WC_Item_Stock extends BWFAN_Cart_Display {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'item_stock';
		$this->tag_description = __( 'Purchased Item Stock', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_item_stock', array( $this, 'parse_shortcode' ) );
	}

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Show the html in popup for the merge tag.
	 */
	public function get_view() {
		$this->get_back_button();

		if ( $this->support_fallback ) {
			$this->get_fallback();
		}

		$this->get_preview();
		$this->get_copy_button();
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
			return $this->get_dummy_preview();
		}

		$this->item_type = 'stock';
		try {
			$result = $this->get_item_details( $attr );
		} catch ( Exception $e ) {
			return $this->parse_shortcode_output( '', $attr );
		}

		return $this->parse_shortcode_output( $result, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return integer
	 */
	public function get_dummy_preview() {
		return 2;
	}


}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_items', 'BWFAN_WC_Item_Stock', null, __( 'Order Item', 'wp-marketing-automations' ) );
}