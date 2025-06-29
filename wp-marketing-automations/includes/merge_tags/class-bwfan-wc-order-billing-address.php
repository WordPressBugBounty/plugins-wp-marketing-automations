<?php

class BWFAN_WC_Order_Billing_Address extends BWFAN_Merge_Tag {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'order_billing_address';
		$this->tag_description = __( 'Order Billing Address', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_order_billing_address', array( $this, 'parse_shortcode' ) );
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
		$this->get_address_format_html();

		if ( $this->support_fallback ) {
			$this->get_fallback();
		}

		$this->get_preview();
		$this->get_copy_button();
	}

	public function get_address_format_html() {
		$templates = array(
			'default'   => __( 'Formatted Address', 'wp-marketing-automations' ),
			'address_1' => __( 'Address 1', 'wp-marketing-automations' ),
			'address_2' => __( 'Address 2', 'wp-marketing-automations' ),
		);
		?>
        <label for=""
               class="bwfan-label-title"><?php esc_html_e( 'Select Address Format', 'wp-marketing-automations' ); ?></label>
        <select id="" class="bwfan-input-wrapper bwfan-mb-15 bwfan_tag_select" name="format" required>
			<?php
			foreach ( $templates as $slug => $name ) {
				echo '<option value="' . esc_attr( $slug ) . '">' . esc_html( $name ) . '</option>';
			}
			?>
        </select>
		<?php
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

		$order_id = BWFAN_Merge_Tag_Loader::get_data( 'order_id' );
		$order    = wc_get_order( $order_id );

		if ( ! $order instanceof WC_Order ) {
			return $this->parse_shortcode_output( ' ', $attr );
		}
		if ( isset( $attr['format'] ) && 'address_1' === $attr['format'] ) {
			$billing_address_1 = $order->get_billing_address_1();

			return $this->parse_shortcode_output( $billing_address_1, $attr );
		}
		if ( isset( $attr['format'] ) && 'address_2' === $attr['format'] ) {
			$billing_address_2 = $order->get_billing_address_2();

			return $this->parse_shortcode_output( $billing_address_2, $attr );
		}

		$address = $order->get_formatted_billing_address();
		if ( isset( $attr['format'] ) && 'comma-separated' === $attr['format'] ) {
			$address = str_replace( '<br/>', ', ', $address );

			return $this->parse_shortcode_output( $address, $attr );
		}
		$address = str_replace( '<br/>', "\n", $address );

		return $this->parse_shortcode_output( $address, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		return '2024 Morningview Lane, New York 10013, USA';
	}

	/**
	 * Return mergetag schema
	 *
	 * @return array[]
	 */
	public function get_setting_schema() {
		$options = [
			[
				'value' => 'default',
				'label' => __( 'Formatted Address', 'wp-marketing-automations' ),
			],
			[
				'value' => 'comma-separated',
				'label' => __( 'Formatted Address Comma Separated', 'wp-marketing-automations' ),
			],
			[
				'value' => 'address_1',
				'label' => __( 'Address 1', 'wp-marketing-automations' ),
			],
			[
				'value' => 'address_2',
				'label' => __( 'Address 2', 'wp-marketing-automations' ),
			],
		];

		return [
			[
				'id'          => 'format',
				'type'        => 'select',
				'options'     => $options,
				'label'       => __( 'Select Address Format', 'wp-marketing-automations' ),
				"class"       => 'bwfan-input-wrapper',
				"placeholder" => __( 'Select', 'wp-marketing-automations' ),
				"required"    => true,
				"description" => ""
			],
		];
	}
}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_order', 'BWFAN_WC_Order_Billing_Address', null, __( 'Order', 'wp-marketing-automations' ) );
}
