<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class BWFCRM_Dashboard extends BWFCRM_Base_React_Page {
	private static $ins = null;
	public $page_data = [];

	public static function get_instance() {
		if ( null === self::$ins ) {
			self::$ins = new self();
		}

		return self::$ins;
	}

	public function __construct() {
		if ( isset( $_GET['page'] ) && 'autonami' === $_GET['page'] ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ), 100 );
			add_filter( 'user_can_richedit', '__return_true' );
			add_action( 'admin_notices', array( $this, 'remove_admin_notice' ), - 1 );
		}
	}

	public function enqueue_assets() {
		$this->prepare_data_for_enqueue();
		$this->enqueue_app_assets( 'main' );
	}

	public function remove_admin_notice() {
		remove_all_actions( 'admin_notices' );
		remove_all_actions( 'all_admin_notices' );
	}

	public function render() {
		?>
        <div id="bwfcrm-page" class="bwfcrm-page"></div>
		<?php
	}
}
