<?php

class BWFAN_WC_Item_Meta extends BWFAN_Cart_Display {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'item_meta';
		$this->tag_description = __( 'Purchased Product Meta Key', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_item_meta', array( $this, 'parse_shortcode' ) );
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
		$this->data_key();
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

		$this->item_type = 'item_meta';
		try {
			$result = $this->get_item_details( $attr );
		} catch ( Exception $e ) {
			return $this->parse_shortcode_output( 0, $attr );
		}

		return $this->parse_shortcode_output( $result, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		return __( 'Value of the key', 'wp-marketing-automations' );
	}

	/**
	 * Return mergetag schema
	 *
	 * @return array[]
	 */
	public function get_setting_schema() {
		return [
			[
				'id'          => 'key',
				'label'       => __( 'Meta Key', 'wp-marketing-automations' ),
				'type'        => 'text',
				'class'       => '',
				'placeholder' => '',
				'hint'        => __( 'Input the correct meta key in order to get the data', 'wp-marketing-automations' ),
				'required'    => true,
				'toggler'     => array(),
			],
		];
	}

}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_items', 'BWFAN_WC_Item_Meta', null, __( 'Order Item', 'wp-marketing-automations' ) );
}