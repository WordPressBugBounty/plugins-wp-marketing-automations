<?php

class BWFAN_Api_Get_Export_Status extends BWFAN_API_Base {

	public static $ins;

	public static function get_instance() {
		if ( null === self::$ins ) {
			self::$ins = new self();
		}

		return self::$ins;
	}

	public function __construct() {
		parent::__construct();
		$this->method       = WP_REST_Server::READABLE;
		$this->route        = '/export/status';
		$this->request_args = array(
			'type' => array(
				'description' => __( 'Export status type', 'wp-marketing-automations' ),
				'type'        => 'string',
			),
		);
	}

	public function default_args_values() {
		return array( 'type' => '' );
	}

	public function process_api_call() {

		$this->response_code = 404;

		/** if isset type param **/
		$type = $this->get_sanitized_arg( 'type', 'text_field' );

		if ( $type === '' ) {
			$response = __( "Exporter type is mandatory", 'wp-marketing-automations' );

			return $this->error_response( $response );
		}

		/** @var  $exporter_registered */
		$exporter_registered = BWFAN_Core()->exporter->get_exporters();

		if ( ! isset( $exporter_registered[ $type ] ) ) {
			$response = __( "Exporter type is not found", 'wp-marketing-automations' );

			return $this->error_response( $response );
		}

		$status_data = [
			'status' => 3,
			'msg'    => [
				'Unable to find the export for user'
			]
		];

		$status = get_user_meta( get_current_user_id(), 'bwfan_single_export_status', true );

		if ( isset( $status[ $type ] ) ) {
			$status_data = $status[ $type ];
		}
		$this->response_code = 200;

		return $this->success_response( $status_data );
	}

}

BWFAN_API_Loader::register( 'BWFAN_Api_Get_Export_Status' );