<?php
if ( ! bwfan_is_autonami_pro_active() || version_compare( BWFAN_PRO_VERSION, '2.0.3', '>=' ) ) {
	class BWFAN_Contact_ID extends BWFAN_Merge_Tag {

		private static $instance = null;

		public function __construct() {
			$this->tag_name        = 'contact_id';
			$this->tag_description = __( 'Contact ID', 'wp-marketing-automations' );
			add_shortcode( 'bwfan_contact_id', array( $this, 'parse_shortcode' ) );
			$this->priority         = 14;
			$this->is_crm_broadcast = true;
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
			$get_data = BWFAN_Merge_Tag_Loader::get_data();
			if ( true === $get_data['is_preview'] ) {
				return $this->parse_shortcode_output( $this->get_dummy_preview(), $attr );
			}

			/** If Contact ID */
			$cid = isset( $get_data['contact_id'] ) ? $get_data['contact_id'] : '';
			if ( absint( $cid ) > 0 ) {
				return $this->parse_shortcode_output( absint( $cid ), $attr );
			}

			/** If order */
			$order = $this->get_order_object( $get_data );
			if ( ! empty( $order ) ) {
				$cid = BWFAN_Woocommerce_Compatibility::get_order_data( $order, '_woofunnel_cid' );
				if ( absint( $cid ) > 0 ) {
					return $this->parse_shortcode_output( absint( $cid ), $attr );
				}
			}

			/** If user ID or Email */
			$user_id = isset( $get_data['user_id'] ) ? $get_data['user_id'] : '';
			$email   = isset( $get_data['email'] ) ? $get_data['email'] : '';

			$contact = bwf_get_contact( $user_id, $email );
			if ( absint( $contact->get_id() ) > 0 ) {
				return $this->parse_shortcode_output( absint( $contact->get_id() ), $attr );
			}

			return $this->parse_shortcode_output( '', $attr );
		}

		/**
		 * Show dummy value of the current merge tag.
		 *
		 * @return string
		 *
		 */
		public function get_dummy_preview() {
			$contact    = $this->get_contact_data();
			$contact_id = 1;
			/** check for contact instance and id */
			if ( ! $contact instanceof WooFunnels_Contact || absint( $contact->get_id() ) === 0 ) {
				return $contact_id;
			}

			/** empty contact id */
			if ( empty( $contact->get_id() ) ) {
				return $contact_id;
			}

			return $contact->get_id();
		}
	}

	/**
	 * Register this merge tag to a group.
	 */
	if ( ! class_exists( 'BWFAN_BWF_Contact_ID' ) ) {
		BWFAN_Merge_Tag_Loader::register( 'bwf_contact', 'BWFAN_Contact_ID', null, __( 'Contact', 'wp-marketing-automations' ) );
	}
}