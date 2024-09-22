<?php

class BWFAN_Add_Contact_To_Automation_Controller {
	public $automation_id = '';
	public $contact_id = '';
	protected $messages = [
		'required_data_missing'     => 'Required data are missing',
		'automation_data_not_found' => 'Automation data not found',
		'automation_is_not_active'  => 'Automation is not active',
		'event_not_found'           => 'Event not found',
		'contact_not_found'         => 'Contact does not exist',
		'not_added_to_automation'   => 'Contact not added to automation',
		'added_to_automation'       => 'Contact added to automation',
		'validation_failed'         => 'Event validation failed',
		'user_not_found'            => 'Wordpress user not found for this contact'
	];

	public function __construct( $automation_id, $contact_id ) {
		$this->automation_id = intval( $automation_id );
		$this->contact_id    = intval( $contact_id );
	}

	public function add_contact_to_automation() {
		if ( empty( $this->automation_id ) || empty( $this->contact_id ) ) {
			return $this->get_response( 404, 'required_data_missing' );
		}

		$automation_data = $this->prepare_automation_data();

		if ( empty( $automation_data ) ) {
			return $this->get_response( 404, 'automation_data_not_found' );
		}

		if ( isset( $automation_data['code'] ) ) {
			return $this->get_response( 404, $automation_data['code'] );
		}

		/** @var BWFAN_Event $event */
		$event = BWFAN_Core()->sources->get_event( $automation_data['event'] );
		if ( ! $event instanceof BWFAN_Event ) {
			return $this->get_response( 404, 'event_not_found' );
		}

		$automation_data = $event->get_manually_added_contact_automation_data( $automation_data, $this->contact_id );
		if ( isset( $automation_data['status'] ) && 0 === $automation_data['status'] ) {
			return $this->get_response( 404, $automation_data['type'], $automation_data['message'] );
		}

		if ( false === $event->validate_v2_event_settings( $automation_data ) ) {
			return $this->get_response( 500, 'validation_failed' );
		}

		$event->global_data = $event->get_event_data( $automation_data );
		$event->event_data  = $event->get_automation_event_data( $automation_data );

		$result = $event->handle_automation_run_v2( $this->automation_id, $automation_data );

		return false === $result ? $this->get_response( 500, 'not_added_to_automation' ) : $this->get_response( 200, 'added_to_automation' );
	}

	public function prepare_automation_data() {
		$ins             = new BWFAN_Automation_Controller();
		$automation_data = $ins->get_automation_data( $this->automation_id );
		if ( empty( $automation_data ) ) {
			return [];
		}

		if ( ! isset( $automation_data['status'] ) || 2 === intval( $automation_data['status'] ) ) {
			return [ 'code' => 'automation_is_not_active' ];
		}

		$automation_data = $this->set_or_unset_extra_data( $automation_data );
		if ( empty( $automation_data ) ) {
			return [];
		}

		$automation_data = BWFAN_Common::remove_extra_automation_data( $automation_data );

		return empty( $automation_data ) ? [] : $automation_data;
	}

	public function set_or_unset_extra_data( $automation_data ) {
		$id         = $automation_data['ID'];
		$meta       = $automation_data['meta'];
		$version    = $automation_data['v'];
		$unset_data = array( 'ID', 'meta', 'v', 'status', 'priority' );
		foreach ( $unset_data as $data ) {
			if ( isset( $automation_data[ $data ] ) ) {
				unset( $automation_data[ $data ] );
			}
		}

		$automation_data['id']      = $id;
		$automation_data['version'] = $version;

		return array_merge( $automation_data, $meta );
	}

	protected function get_response( $code, $type = '', $msg = '' ) {
		$msg = ! empty( $msg ) ? $msg : ( isset( $this->messages[ $type ] ) ? $this->messages[ $type ] : '' );

		return [ 'code' => $code, 'message' => __( $msg, 'wp-marketing-automations' ) ];
	}

}
