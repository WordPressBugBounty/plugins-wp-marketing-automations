<?php

class BWFAN_WC_Cart_Shipping_Country extends Cart_Merge_Tag {

	private static $instance = null;


	public function __construct() {
		$this->tag_name        = 'cart_shipping_country';
		$this->tag_description = __( 'Cart Shipping Country', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_cart_shipping_country', array( $this, 'parse_shortcode' ) );

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

		$field_value = $this->get_cart_value( 'shipping_country', $cart_details );

		return $this->parse_shortcode_output( $field_value, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		return 'Australia';
	}

	public function post_value_check( $field_value ) {
		return WC()->countries->countries[ $field_value ];
	}

	/**
	 * Returns merge tag setting schema
	 */
	public function get_setting_schema() {
		return [
			[
				'id'          => 'format',
				'type'        => 'select',
				'options'     => [
					[
						'value' => 'iso',
						'label' => __( 'ISO code 2 digit', 'wp-marketing-automations' ),
					],
					[
						'value' => 'full',
						'label' => __( 'Nice Name', 'wp-marketing-automations' ),
					],
				],
				'label'       => __( 'Format', 'wp-marketing-automations' ),
				"class"       => 'bwfan-input-wrapper',
				"placeholder" => 'Select',
				"required"    => false,
				"description" => ""
			]
		];
	}
}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_ab_cart', 'BWFAN_WC_Cart_Shipping_Country', null, __( 'Abandoned Cart', 'wp-marketing-automations' ) );
}