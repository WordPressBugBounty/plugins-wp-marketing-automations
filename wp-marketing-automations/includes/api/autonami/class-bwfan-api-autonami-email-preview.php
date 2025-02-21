<?php

/**
 * Autonami Email Preview API class
 */
class BWFAN_API_Campaign_Email_Preview extends BWFAN_API_Base {

	public static $ins;

	/**
	 * Return class instance
	 */
	public static function get_instance() {
		if ( null === self::$ins ) {
			self::$ins = new self();
		}

		return self::$ins;
	}

	/**
	 * Class constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->method = WP_REST_Server::EDITABLE;
		$this->route  = '/autonami/email-preview';
	}

	/**
	 * Default arg.
	 */
	public function default_args_values() {
		return array(
			'content' => 0
		);
	}

	/**
	 * API callback
	 */
	public function process_api_call() {

		$content = '';
		$type    = ! empty( $this->args['type'] ) ? $this->args['type'] : 'rich';
		if ( ! empty( $this->args['content'] ) ) {
			$content = $this->args['content'];
		}
		$data = [];

		/** getting the template type in id */
		switch ( $type ) {
			case 'rich':
				$data['template'] = 1;
				break;
			case 'wc':
				if ( class_exists( 'WooCommerce' ) ) {
					$data['template'] = 2;
				}
				break;
			case 'html':
				$data['template'] = 3;
				break;
			case 'editor':
				if ( bwfan_is_autonami_pro_active() ) {
					$data['template'] = 4;
				}
				break;
			case 'block':
				if ( bwfan_is_autonami_pro_active() ) {
					$data['template'] = 5;
				}
				break;
			default:
				$data['template'] = 1;
		}

		BWFAN_Common::bwfan_before_send_mail( $type );
		BWFAN_Merge_Tag_Loader::set_data( array(
			'is_preview' => true,
		) );

		$body = BWFAN_Common::correct_shortcode_string( $content, $type );
		$body = BWFAN_Common::decode_merge_tags( $body );
		$body = BWFAN_Common::bwfan_correct_protocol_url( $body );

		$data['body']        = $body;
		$action_object       = BWFAN_Core()->integration->get_action( 'wp_sendemail' );
		$body                = $action_object->email_content_v2( $data );
		$this->response_code = 200;

		return $this->success_response( [ 'body' => $body ] );
	}
}

BWFAN_API_Loader::register( 'BWFAN_API_Campaign_Email_Preview' );