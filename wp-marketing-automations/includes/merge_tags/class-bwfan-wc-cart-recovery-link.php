<?php

class BWFAN_WC_Cart_Recovery_Link extends BWFAN_Merge_Tag {

	private static $instance = null;

	public function __construct() {
		$this->tag_name        = 'cart_recovery_link';
		$this->tag_description = __( 'Cart Recovery URL', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_cart_recovery_link', array( $this, 'parse_shortcode' ) );
		$this->support_fallback = false;
		$this->priority         = 3;
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
		?>
        <div class="bwfan_mtag_wrap">
            <div class="bwfan_label">
                <label for="" class="bwfan-label-title"><?php esc_html_e( 'Auto Apply Coupon Through Recovery Link', 'wp-marketing-automations' ); ?></label>
            </div>
            <div class="bwfan_label_val">
                <div class="radio-list">
                    <input type="radio" id="add_recovery_url_coupon" name="add_recovery_url_coupon" value="yes"><?php esc_html_e( 'Yes', 'wp-marketing-automations' ); ?>
                    <input type="radio" id="add_recovery_url_coupon" name="add_recovery_url_coupon" value="no" checked><?php esc_html_e( 'No', 'wp-marketing-automations' ); ?>
                </div>
            </div>
        </div>
        <div class="bwfan_mtag_wrap" style="display: none;">
            <div class="bwfan_label">
                <label for="" class="bwfan-label-title"><?php esc_html_e( 'Coupon Code', 'wp-marketing-automations' ); ?></label>
            </div>
            <div class="bwfan_label_val">
                <input type="text" class="bwfan-input-wrapper bwfan_tag_input recovery_url_coupon" id="recovery_url_coupon" name="recovery_url_coupon" placeholder="<?php esc_html_e( 'Enter Coupon Code', 'wp-marketing-automations' ); ?>">
            </div>
        </div>
		<?php

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

		$abandoned_row_details = BWFAN_Merge_Tag_Loader::get_data( 'cart_details' );

		if ( empty( $abandoned_row_details ) ) {
			$abandoned_id          = BWFAN_Merge_Tag_Loader::get_data( 'cart_abandoned_id' );
			$abandoned_row_details = BWFAN_Model_Abandonedcarts::get( $abandoned_id );
		}

		if ( empty( $abandoned_row_details ) ) {
			return $this->parse_shortcode_output( '', $attr );
		}

		$checkout_data = json_decode( $abandoned_row_details['checkout_data'], true );

		$lang = isset( $checkout_data['lang'] ) ? $checkout_data['lang'] : '';

		if ( isset( $attr['coupon'] ) && ! empty( $attr['coupon'] ) ) {
			$cart_url = BWFAN_Common::wc_get_cart_recovery_url( $abandoned_row_details['token'], $attr['coupon'], $lang, $checkout_data );
		} else {
			$cart_url = BWFAN_Common::wc_get_cart_recovery_url( $abandoned_row_details['token'], '', $lang, $checkout_data );
		}

		/** Maybe set automation id */
		$automation_id = BWFAN_Merge_Tag_Loader::get_data( 'automation_id' );
		if ( absint( $automation_id ) > 0 ) {
			$cart_url = add_query_arg( array(
				'automation-id' => $automation_id,
			), $cart_url );
		}

		return $this->parse_shortcode_output( $cart_url, $attr );
	}

	/**
	 * Show dummy value of the current merge tag.
	 *
	 * @return string
	 */
	public function get_dummy_preview() {
		$cart_url = add_query_arg( array(
			'bwfan-ab-id'       => md5( '123' ),
			'cart_restore_test' => 'yes',
		), wc_get_page_permalink( 'checkout' ) );

		return $cart_url;
	}

	/**
	 * Return mergetag schema
	 *
	 * @return array[]
	 */
	public function get_setting_schema() {
		return [
			[
				'id'          => 'coupon_type',
				'label'       => __( 'Coupon Type', 'wp-marketing-automations' ),
				'type'        => 'radio',
				'options'     => [
					[
						'label' => __( "Static Coupon", 'wp-marketing-automations' ),
						'value' => 'static',
					],
					[
						'label' => __( "Dynamic Coupon", 'wp-marketing-automations' ),
						'value' => 'dynamic',
					]
				],
				'class'       => 'inline-radio-field',
				'required'    => false,
				'wrap_before' => '',
			],
			[
				'id'       => 'static_coupon',
				'label'    => __( 'Coupon Code ( Optional )', 'wp-marketing-automations' ),
				'type'     => 'text',
				'class'    => '',
				'hint'     => __( 'Auto Apply Coupon Through Recovery Link', 'wp-marketing-automations' ),
				'required' => false,
				'toggler'  => [
					'fields'   => [
						[
							'id'    => 'coupon_type',
							'value' => 'static'
						]
					],
					'relation' => 'OR',
				],
			],
			[
				'id'          => 'dynamic_coupon',
				'type'        => 'ajax',
				'label'       => __( 'Please Select Dynamic Coupon', 'wp-marketing-automations' ),
				"class"       => 'bwfan-input-wrapper',
				"required"    => false,
				'placeholder' => 'Select',
				"description" => "",
				"ajax_cb"     => 'bwfan_get_automation_wc_dynamic_coupon',
				"ajax_field"  => [
					'merge_tag' => 'coupon_type'
				],
				'toggler'     => [
					'fields'   => [
						[
							'id'    => 'coupon_type',
							'value' => 'dynamic'
						]
					],
					'relation' => 'OR',
				],
			],
		];
	}

	/**
	 * Return mergetag schema
	 *
	 * @return array[]
	 */
	public function get_default_values() {
		return [
			'coupon_type' => 'static',
		];
	}
}

/**
 * Register this merge tag to a group.
 */
if ( bwfan_is_woocommerce_active() ) {
	BWFAN_Merge_Tag_Loader::register( 'wc_ab_cart', 'BWFAN_WC_Cart_Recovery_Link', null, __( 'Abandoned Cart', 'wp-marketing-automations' ) );
}