<?php

class BWFAN_API_Get_Automation_Conversions extends BWFAN_API_Base {
	public static $ins;
	private $aid = 0;

	public static function get_instance() {
		if ( null === self::$ins ) {
			self::$ins = new self();
		}

		return self::$ins;
	}

	public $total_count = 0;

	public function __construct() {
		parent::__construct();
		$this->method             = WP_REST_Server::READABLE;
		$this->route              = 'v3/automation/(?P<automation_id>[\\d]+)/conversions/';
		$this->pagination->offset = 0;
		$this->pagination->limit  = 10;
		$this->request_args       = array(
			'automation_id' => array(
				'description' => __( 'Automation ID to retrieve', 'wp-marketing-automations' ),
				'type'        => 'integer',
			),
			'offset'        => array(
				'description' => __( 'Contacts list Offset', 'wp-marketing-automations' ),
				'type'        => 'integer',
			),
			'limit'         => array(
				'description' => __( 'Per page limit', 'wp-marketing-automations' ),
				'type'        => 'integer',
			)
		);
	}

	public function process_api_call() {
		$automation_id  = $this->get_sanitized_arg( 'automation_id', 'text_field' );
		$automation_obj = BWFAN_Automation_V2::get_instance( $automation_id );

		/** Check for automation exists */
		if ( ! empty( $automation_obj->error ) ) {
			return $this->error_response( [], $automation_obj->error );
		}
		$this->aid = $automation_id;

		$conversions                    = $this->get_conversions( $automation_id, $this->pagination->offset, $this->pagination->limit );
		$conversions['automation_data'] = $automation_obj->automation_data;

		if ( isset( $conversions['automation_data']['v'] ) && 1 === absint( $conversions['automation_data']['v'] ) ) {
			$meta                                    = BWFAN_Model_Automationmeta::get_automation_meta( $automation_id );
			$conversions['automation_data']['title'] = isset( $meta['title'] ) ? $meta['title'] : '';
		}

		if ( empty( $conversions['total'] ) ) {
			$this->response_code = 404;
			$response            = __( "No orders found", "wp-marketing-automations" );

			return $this->success_response( $conversions, $response );
		}
		$this->total_count = $conversions['total'];

		return $this->success_response( $conversions, __( 'Got All Orders', 'wp-marketing-automations' ) );
	}

	public function get_result_total_count() {
		return $this->total_count;
	}

	/**
	 * @return array
	 */
	public function get_result_count_data() {
		return [
			'failed' => BWFAN_Model_Automation_Contact::get_active_count( $this->aid, 2 )
		];
	}

	public function get_conversions( $automation_id, $offset = 0, $limit = 25 ) {
		if ( empty( $automation_id ) ) {
			return [ 'conversions' => [], 'total' => 0 ];
		}

		return BWFAN_Model_Conversions::get_conversions_by_source_type( $automation_id, BWFAN_Email_Conversations::$TYPE_AUTOMATION, $limit, $offset );
	}
}

BWFAN_API_Loader::register( 'BWFAN_API_Get_Automation_Conversions' );
