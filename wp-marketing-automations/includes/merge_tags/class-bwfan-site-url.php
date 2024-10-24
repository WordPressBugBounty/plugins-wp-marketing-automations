<?php

class BWFAN_Site_Url extends BWFAN_Merge_Tag {

	private static $instance = null;


	public function __construct() {
		$this->tag_name        = 'site_url';
		$this->tag_description = __( 'Website URL', 'wp-marketing-automations' );
		add_shortcode( 'bwfan_site_url', array( $this, 'parse_shortcode' ) );
		add_shortcode( 'bwfan_site_link', array( $this, 'parse_shortcode' ) );
		$this->support_fallback = false;
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
	 * @return mixed|void
	 */
	public function parse_shortcode( $attr ) {
		$block_editor_setting = BWFAN_Common::get_block_editor_settings();
		if ( ! isset( $block_editor_setting['site'] ) || ! isset( $block_editor_setting['site']['url'] ) || empty( $block_editor_setting['site']['url'] ) ) {
			return $this->parse_shortcode_output( home_url(), $attr );
		}

		return $this->parse_shortcode_output( $block_editor_setting['site']['url'], $attr );
	}
}

/**
 * Register this merge tag to a group.
 */
BWFAN_Merge_Tag_Loader::register( 'bwfan_default', 'BWFAN_Site_Url', null, __( 'General', 'wp-marketing-automations' ) );
