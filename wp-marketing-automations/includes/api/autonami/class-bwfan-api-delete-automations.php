<?php

class BWFAN_API_Delete_Automations extends BWFAN_API_Base {
	public static $ins;

	public static function get_instance() {
		if ( null === self::$ins ) {
			self::$ins = new self();
		}

		return self::$ins;
	}

	public $total_count = 0;

	public function __construct() {
		parent::__construct();
		$this->method = WP_REST_Server::DELETABLE;;
		$this->route = '/automations/';
	}

	public function default_args_values() {
		$args = [
			'automation_ids' => []
		];

		return $args;
	}

	public function process_api_call() {
		$automation_ids          = $this->args['automation_ids'];
		$not_deleted_automations = array();

		if ( empty( $automation_ids ) || ! is_array( $automation_ids ) ) {
			return $this->error_response( __( 'Automations ids is missing.', 'wp-marketing-automations' ) );
		}

		foreach ( $automation_ids as $automation_id ) {
			$event_details = BWFAN_Model_Automations::get( $automation_id );
			$ids           = array( $automation_id );
			if ( empty( $event_details ) ) {
				$not_deleted_automations[] = $automation_id;
				continue;
			}

			/** Initiate automation object */
			$automation_obj = BWFAN_Automation_V2::get_instance( $automation_id );
			if ( ! empty( $automation_obj->error ) ) {
				continue;
			}
			$data = $automation_obj instanceof BWFAN_Automation_V2 ? $automation_obj->get_automation_data() : [];
			if ( 2 === intval( $data['v'] ) ) {
				$automation_obj->delete_migrations( $automation_id );
			}

			BWFAN_Core()->automations->delete_automation( $ids );
			BWFAN_Core()->automations->delete_automationmeta( $ids );

			if ( 1 === intval( $data['v'] ) ) {
				BWFAN_Core()->tasks->delete_tasks( array(), $ids );
				BWFAN_Core()->logs->delete_logs( array(), $ids );

				// Set status of logs to 0, so that run now option for those logs can be hide
				BWFAN_Model_Logs::update( array(
					'status' => 0,
				), array(
					'automation_id' => $automation_id,
				) );
			}

			BWFAN_Core()->automations->set_automation_id( $automation_id );

			do_action( 'bwfan_automation_deleted', $automation_id );
		}

		if ( ! empty( $not_deleted_automations ) ) {
			$message = __( 'Unable to Delete Automations with ids', 'wp-marketing-automations' ) . ': ' . implode( ', ', $not_deleted_automations );

			return $this->success_response( [], $message );
		}

		return $this->success_response( [], __( 'Automations deleted', 'wp-marketing-automations' ) );
	}
}

BWFAN_API_Loader::register( 'BWFAN_API_Delete_Automations' );