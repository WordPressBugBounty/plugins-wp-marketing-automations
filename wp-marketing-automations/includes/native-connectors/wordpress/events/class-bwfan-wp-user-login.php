<?php

#[AllowDynamicProperties]
final class BWFAN_WP_User_Login extends BWFAN_Event {
	private static $instance = null;
	public $user = null;
	public $user_id = null;

	private function __construct() {
		$this->optgroup_label         = esc_html__( 'User', 'wp-marketing-automations' );
		$this->event_name             = esc_html__( 'User Login', 'wp-marketing-automations' );
		$this->event_desc             = esc_html__( 'This event runs after a user logged in.', 'wp-marketing-automations' );
		$this->event_merge_tag_groups = array( 'bwf_contact' );
		$this->event_rule_groups      = array(
			'wp_user',
			'bwf_contact_segments',
			'bwf_contact',
			'bwf_contact_fields',
			'bwf_contact_user',
			'bwf_contact_wc',
			'bwf_contact_geo',
			'bwf_engagement',
			'bwf_broadcast'
		);
		$this->priority               = 105.1;
		$this->v2                     = true;
		$this->automation_add         = true;
	}

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function load_hooks() {
		add_action( 'wp_login', array( $this, 'user_logged_in' ), 10, 2 );
	}

	/**
	 * Set up rules data
	 *
	 * @param $value
	 */
	public function pre_executable_actions( $value ) {
		BWFAN_Core()->rules->setRulesData( $this->user, 'wp_user' );
		BWFAN_Core()->rules->setRulesData( $this->user_id, 'user_id' );
		BWFAN_Core()->rules->setRulesData( BWFAN_Common::get_bwf_customer( $this->user->user_email, $this->user_id ), 'bwf_customer' );
	}

	/**
	 * @param $user_login
	 * @param $user WP_User
	 *
	 * @return void
	 */
	public function user_logged_in( $user_login = false, $user = false ) {
		$user = BWFAN_Common::get_user( $user_login, $user );
		if ( empty( $user ) || ! $user instanceof WP_User ) {
			return;
		}

		$this->process( array(
			'user_id' => $user->ID,
		) );
	}

	/**
	 * Make the required data for the current event and send it asynchronously.
	 *
	 * @param $details
	 */
	public function process( $details ) {
		$data            = $this->get_default_data();
		$data['details'] = $details;

		$this->send_async_call( $data );
	}

	/**
	 * Registers the tasks for current event.
	 *
	 * @param $automation_id
	 * @param $integration_data
	 * @param $event_data
	 */
	public function register_tasks( $automation_id, $integration_data, $event_data ) {
		if ( ! is_array( $integration_data ) ) {
			return;
		}
		$data_to_send = $this->get_event_data();

		$this->create_tasks( $automation_id, $integration_data, $event_data, $data_to_send );
	}

	public function get_event_data() {
		$data_to_send                      = array();
		$data_to_send['global']['user_id'] = $this->user_id;
		$data_to_send['global']['email']   = is_object( $this->user ) ? $this->user->user_email : '';

		return $data_to_send;
	}

	/**
	 * Make the view data for the current event which will be shown in task listing screen.
	 *
	 * @param $global_data
	 *
	 * @return false|string
	 */
	public function get_task_view( $global_data ) {
		ob_start();
		$user_data = get_userdata( $global_data['user_id'] );
		?>
        <li>
            <strong><?php esc_html_e( 'User:', 'wp-marketing-automations' ); ?> </strong>
            <a target="_blank" href="<?php echo admin_url( 'user-edit.php?user_id=' . $global_data['user_id'] ); //phpcs:ignore WordPress.Security.EscapeOutput ?>"><?php echo esc_html( $user_data->user_nicename ); ?></a>
        </li>
        <li>
            <strong><?php esc_html_e( 'Email:', 'wp-marketing-automations' ); ?> </strong>
            <span><?php echo esc_html( $global_data['email'] ); ?></span>
        </li>
		<?php
		return ob_get_clean();
	}

	public function get_email_event() {
		if ( $this->user instanceof WP_User ) {
			return $this->user->user_email;
		}

		if ( ! empty( absint( $this->user_id ) ) ) {
			$user = get_user_by( 'id', absint( $this->user_id ) );

			return false !== $user ? $user->user_email : false;
		}

		return false;
	}

	public function get_user_id_event() {
		if ( ! empty( absint( $this->user_id ) ) ) {
			return absint( $this->user_id );
		}

		if ( $this->user instanceof WP_User ) {
			return $this->user->ID;
		}

		return false;
	}

	/**
	 * Set global data for all the merge tags which are supported by this event.
	 *
	 * @param $task_meta
	 */
	public function set_merge_tags_data( $task_meta ) {
		$get_data = BWFAN_Merge_Tag_Loader::get_data( 'user_id' );
		if ( empty( $get_data ) || intval( $get_data ) !== intval( $task_meta['global']['user_id'] ) ) {
			$set_data = array(
				'user_id' => intval( $task_meta['global']['user_id'] ),
				'email'   => $task_meta['global']['email'],
				'wp_user' => get_user_by( 'ID', $task_meta['global']['user_id'] ),
			);
			BWFAN_Merge_Tag_Loader::set_data( $set_data );
		}
	}

	/**
	 * Capture the async data for the current event.
	 *
	 * @return array|bool
	 */
	public function capture_async_data() {
		$details       = BWFAN_Common::$events_async_data['details'];
		$this->user_id = intval( $details['user_id'] );
		$this->user    = get_user_by( 'ID', $this->user_id );

		return $this->run_automations();
	}

	/**
	 * Capture the async data for the current event.
	 *
	 * @return array|bool
	 */
	public function capture_v2_data( $automation_data ) {
		$details       = BWFAN_Common::$events_async_data['details'];
		$this->user_id = absint( $details['user_id'] );
		$this->user    = get_user_by( 'ID', $this->user_id );

		$automation_data['user_id'] = $this->user_id;
		$automation_data['email']   = $this->user instanceof WP_User ? $this->user->user_email : '';

		return $automation_data;
	}

	/**
	 * Get contact automation data for manual triggers
	 *
	 * @param $automation_data
	 * @param $cid
	 *
	 * @return array
	 */
	public function get_manually_added_contact_automation_data( $automation_data, $cid ) {
		$contact = new WooFunnels_Contact( '', '', '', $cid );

		/** Check if contact exists */
		if ( ! $contact instanceof WooFunnels_Contact || empty( $contact->get_id() ) ) {
			return [ 'status' => 0, 'type' => 'contact_not_found' ];
		}

		$user_id = $contact->get_wpid();

		/** Validate user ID */
		if ( empty( $user_id ) || $user_id <= 0 ) {
			return [ 'status' => 0, 'type' => 'user_not_found' ];
		}

		/**  Verify user exists */
		$user = get_user_by( 'id', $user_id );
		if ( ! $user instanceof WP_User ) {
			return [ 'status' => 0, 'type' => '', 'message' => __( "Associated user no longer exists.", 'wp-marketing-automations' ) ];
		}

		/**  Set user data for the event */
		$this->user_id = $user_id;
		$this->user    = $user;

		/** Merge automation data with user info */
		$data = [
			'user_id' => $user_id,
		];

		return array_merge( $automation_data, $data );
	}
}

/**
 * Register this event to a source.
 * This will show the current event in dropdown in single automation screen.
 */
return 'BWFAN_WP_User_Login';
