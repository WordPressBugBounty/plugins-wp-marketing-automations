<?php

/**
 * Class BWFAN_WC_Order_Billing_Last_Name
 *
 * Merge tag outputs order billing last name
 *
 * Since 2.0.6
 */
class BWFAN_WC_Order_Billing_Last_Name extends BWFAN_Merge_Tag {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'order_billing_last_name';
		$this->tag_description = __( 'Order Billing Last Name', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_order_billing_last_name', array( $this, 'parse_shortcode' ) );
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

		$order_id = BWFAN_Merge_Tag_Loader::get_data( 'order_id' );
		$order    = wc_get_order( $order_id );

		if ( ! $order instanceof WC_Order ) {
			return $this->parse_shortcode_output( '', $attr );
		}

		$billing_last_name = BWFAN_Woocommerce_Compatibility::get_order_data( $order, '_billing_last_name' );

		return $this->parse_shortcode_output( $billing_last_name, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		$contact   = $this->get_contact_data();
		$last_name = 'Wright';
		/** check for contact instance and the contact id */
		if ( ! $contact instanceof WooFunnels_Contact || 0 === absint( $contact->get_id() ) ) {
			return $last_name;
		}

		/** If empty */
		if ( empty( $contact->get_l_name() ) ) {
			return $last_name;
		}

		return ucfirst( $contact->get_l_name() );
	}
}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_order', 'BWFAN_WC_Order_Billing_Last_Name', null, __( 'Order', 'wp-marketing-automations' ) );
}
