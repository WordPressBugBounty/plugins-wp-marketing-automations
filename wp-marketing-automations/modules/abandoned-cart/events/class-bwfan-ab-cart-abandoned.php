<?php

#[AllowDynamicProperties]
final class BWFAN_AB_Cart_Abandoned extends BWFAN_Event {
	private static $instance = null;
	public $emails = [];
	public $tokens = [];
	public $cart_items = [];
	public $abandoned_email = false;
	public $abandoned_id = null;
	public $token = null;
	public $cart_item = null;
	public $user_id = false;
	public $abandoned_data = array();
	public $abandoned_phone = null;

	/** v2 */
	public $contact_data_v2 = array();

	public function __construct( $source_slug ) {
		$this->source_type            = $source_slug;
		$this->optgroup_label         = __( 'Cart', 'wp-marketing-automations' );
		$this->event_name             = __( 'Cart Abandoned', 'wp-marketing-automations' );
		$this->event_desc             = __( 'This automation would trigger when a user abandoned the cart.', 'wp-marketing-automations' );
		$this->event_merge_tag_groups = array( 'wc_ab_cart', 'bwf_contact' );
		$this->event_rule_groups      = array(
			'ab_cart',
			'aerocheckout',
			'bwf_contact_segments',
			'bwf_contact',
			'bwf_contact_fields',
			'bwf_contact_user',
			'bwf_contact_wc',
			'bwf_contact_geo',
			'bwf_engagement',
			'bwf_broadcast'
		);
		$this->support_lang           = true;
		$this->priority               = 5;
		$this->customer_email_tag     = '{{cart_billing_email}}';
		$this->v2                     = true;
		$this->optgroup_priority      = 5;
		$this->supported_blocks       = [ 'cart' ];
		$this->automation_add         = true;
	}

	public function load_hooks() {
	}

	public static function get_instance( $source_slug ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $source_slug );
		}

		return self::$instance;
	}

	/**
	 * Get all the abandoned rows from db table. It runs at every 2 minutes.
	 */
	public function get_eligible_abandoned_rows() {
		global $wpdb;
		$global_settings           = BWFAN_Common::get_global_settings();
		$abandoned_time_in_minutes = intval( $global_settings['bwfan_ab_init_wait_time'] );

		/** Status 0: Pending, 4: Re-Scheduled */
		$query = $wpdb->prepare( 'SELECT * FROM {table_name} WHERE TIMESTAMPDIFF(MINUTE,last_modified,UTC_TIMESTAMP) >= %d AND status IN (0,4)', $abandoned_time_in_minutes );

		$active_abandoned_carts = BWFAN_Model_Abandonedcarts::get_results( $query );
		if ( ! is_array( $active_abandoned_carts ) || count( $active_abandoned_carts ) === 0 ) {
			return;
		}
		$active_abandoned_carts = BWFAN_Abandoned_Cart::remove_duplicate_cart( $active_abandoned_carts );
		$ids                    = array_column( $active_abandoned_carts, 'ID', 'ID' );

		/** Status 1: In-Progress (Automations Found), 3: Pending (No Tasks Found) */
		BWFAN_Core()->public->load_active_automations( $this->get_slug() );
		BWFAN_Core()->public->load_active_v2_automations( $this->get_slug() );

		if ( ( ! is_array( $this->automations_arr ) || count( $this->automations_arr ) === 0 ) && ( ! is_array( $this->automations_v2_arr ) || count( $this->automations_v2_arr ) === 0 ) ) {
			/** Status 3 - No automation found */
			BWFAN_Common::update_abandoned_rows( $ids, 3 );

			return;
		}

		$days_to_check = isset( $global_settings['bwfan_disable_abandonment_days'] ) && intval( $global_settings['bwfan_disable_abandonment_days'] ) > 0 ? intval( $global_settings['bwfan_disable_abandonment_days'] ) : 0;
		if ( ! empty( $days_to_check ) ) {
			$after_date = date( 'Y-m-d H:i:s', strtotime( " -$days_to_check day" ) );
		}

		foreach ( $active_abandoned_carts as $active_abandoned_cart ) {
			BWFAN_Common::maybe_create_abandoned_contact( $active_abandoned_cart );// create contact at the time of abandonment

			if ( empty( $days_to_check ) ) {
				$this->process( $active_abandoned_cart );
				continue;
			}
			/** Cool Off period checking */
			$query      = "SELECT customers.l_order_date FROM {$wpdb->prefix}bwf_wc_customers AS customers
					WHERE EXISTS (
						SELECT 1
						FROM {$wpdb->prefix}bwf_contact AS contact
						WHERE contact.email = %s
						AND contact.id = customers.cid
					)
					AND customers.l_order_date >= %s
					LIMIT 1";
			$last_order = $wpdb->get_var( $wpdb->prepare( $query, $active_abandoned_cart['email'], $after_date ) ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching

			if ( ! empty( $last_order ) ) {
				/** Order found. No need to process the cart */
				/** Status 5 - Under Cool off period */
				BWFAN_Common::update_abandoned_rows( [ $active_abandoned_cart['ID'] ], 5 );
				continue;
			}

			$this->process( $active_abandoned_cart );
		}
	}

	/**
	 * Set up rules data
	 *
	 * @param $value
	 */
	public function pre_executable_actions( $value ) {
		BWFAN_Core()->rules->setRulesData( $this->abandoned_data, 'abandoned_data' );
	}

	/**
	 * Make the required data for the current event and send it asynchronously.
	 *
	 * @param $abandoned_cart
	 *
	 * @return array|bool|void
	 */
	public function process( $abandoned_cart ) {
		$this->abandoned_id   = $abandoned_cart['ID'];
		$this->abandoned_data = BWFAN_Model_Abandonedcarts::get( $this->abandoned_id );

		if ( ! is_array( $this->abandoned_data ) ) {
			BWFAN_Common::update_abandoned_rows( [ $abandoned_cart['ID'] ], 3 );

			return;
		}

		$this->abandoned_email = $this->abandoned_data['email'];
		$this->token           = $abandoned_cart['token'];
		$this->cart_item       = $this->abandoned_data['items'];
		$this->user_id         = $abandoned_cart['user_id'];
		$this->abandoned_phone = $this->get_abandoned_phone( $this->abandoned_data );

		$this->contact_data_v2 = array(
			'abandoned_id' => absint( $this->abandoned_id ),
			'email'        => $this->abandoned_email,
			'user_id'      => $this->user_id,
			'cart_item'    => $this->abandoned_data['items'],
			'phone'        => $this->abandoned_phone,
			'event'        => $this->get_slug(),
			'version'      => 2
		);

		return $this->run_automations();
	}

	/** get abandoned phone number
	 *
	 * @param $abandoned_data
	 *
	 * @return mixed|string|void
	 */
	public function get_abandoned_phone( $abandoned_data ) {
		if ( empty( $abandoned_data ) ) {
			return '';
		}

		$phone         = '';
		$checkout_data = json_decode( $abandoned_data['checkout_data'], true );

		if ( ! isset( $checkout_data['fields'] ) || empty( $checkout_data['fields'] ) ) {
			return $phone;
		}

		$checkout_fields = $checkout_data['fields'];

		/** check if the billing phone available  */
		if ( isset( $checkout_fields['billing_phone'] ) && ! empty( $checkout_fields['billing_phone'] ) ) {
			$phone = $checkout_fields['billing_phone'];
		}

		/** check if the billing phone available  */
		if ( empty( $phone ) && isset( $checkout_fields['shipping_phone'] ) && ! empty( $checkout_fields['shipping_phone'] ) ) {
			$phone = $checkout_fields['shipping_phone'];
		}

		/** still empty then return */
		if ( empty( $phone ) ) {
			return $phone;
		}

		$cart_phone   = $phone;
		$cart_country = '';

		/** check for billing country */
		if ( isset( $checkout_fields['billing_country'] ) && ! empty( $checkout_fields['billing_country'] ) ) {
			$cart_country = $checkout_fields['billing_country'];
		}

		/** check for shipping country */
		if ( empty( $cart_country ) && isset( $checkout_fields['shipping_country'] ) && ! empty( $checkout_fields['shipping_country'] ) ) {
			$cart_country = $checkout_fields['shipping_country'];
		}

		/** cart country not exists than return cart phone without country */
		if ( empty( $cart_country ) ) {
			return $cart_phone;
		}

		$phone = BWFAN_Phone_Numbers::add_country_code( $cart_phone, $cart_country );

		return $phone;
	}

	/**
	 * Override method to change the state of Cart based on Automations found
	 *
	 * @return array|bool
	 */
	public function run_automations() {
		$any_automation_ran = BWFAN_Common::maybe_run_v2_automations( $this->get_slug(), $this->contact_data_v2 );

		/** Run v1 automations */
		$automation_actions = array();

		foreach ( $this->automations_arr as $automation_id => $automation_data ) {
			if ( $this->get_slug() !== $automation_data['event'] || 0 !== intval( $automation_data['requires_update'] ) ) {
				continue;
			}
			$ran_actions = $this->handle_single_automation_run( $automation_data, $automation_id );

			$automation_actions[ $automation_id ] = $ran_actions;
		}

		/**
		 * We found no tasks to create. And no v2 automation contact row created
		 * So, setting status 3 i.e. Pending (No Tasks Found)
		 */
		if ( 0 === array_sum( $automation_actions ) && ! $any_automation_ran ) {
			BWFAN_Common::update_abandoned_rows( array( $this->abandoned_id ), 3 );

			return $automation_actions;
		}

		/** Updating carts to in-progress i.e. 1 state */
		BWFAN_Common::update_abandoned_rows( array( $this->abandoned_id ), 1 );

		return $automation_actions;
	}

	/**
	 * Override method to change the state of Cart based on Tasks to be created
	 *
	 * @param $automation_data
	 * @param $automation_id
	 *
	 * @return bool|int
	 */
	public function handle_single_automation_run( $automation_data, $automation_id ) {
		$this->event_automation_id = $automation_id;

		/** Setup the rules data */
		$this->pre_executable_actions( $automation_data );

		/** get all the actions which have passed the rules */
		$actions = $this->get_executable_actions( $automation_data );

		if ( ! isset( $actions['actions'] ) || ! is_array( $actions['actions'] ) || count( $actions['actions'] ) === 0 ) {
			return 0;
		}

		$event_data = $this->get_automation_event_data( $automation_data );

		try {
			/** Register all those tasks which passed through rules or which are direct actions. The following function is present in every event class. */
			$this->register_tasks( $automation_id, $actions['actions'], $event_data );
		} catch ( Exception $exception ) {
			BWFAN_Core()->logger->log( 'Register task function not overrided by child class' . get_class( $this ), $this->log_type );
		}

		return count( $actions['actions'] );
	}

	/**
	 * Registers the tasks for current event.
	 *
	 * @param $automation_id
	 * @param $integration_data
	 * @param $event_data
	 */
	public function register_tasks( $automation_id, $integration_data, $event_data ) {
		$data_to_send = $this->get_event_data();
		add_action( 'bwfan_task_created_ab_cart_abandoned', [ $this, 'update_task_meta' ], 10, 2 );

		$this->create_tasks( $automation_id, $integration_data, $event_data, $data_to_send );
	}

	public function get_event_data() {
		$data_to_send                                = [];
		$data_to_send['global']['email']             = $this->abandoned_email;
		$data_to_send['global']['cart_abandoned_id'] = $this->abandoned_id;
		$data_to_send['global']['cart_details']      = $this->abandoned_data;
		$data_to_send['global']['phone']             = $this->abandoned_phone;
		$data_to_send['global']['user_id']           = $this->user_id;
		$checkout_data                               = isset( $this->abandoned_data['checkout_data'] ) ? json_decode( $this->abandoned_data['checkout_data'], true ) : [];
		$data_to_send['global']['language']          = isset( $checkout_data['lang'] ) ? $checkout_data['lang'] : '';

		return $data_to_send;
	}

	/**
	 * If any event has email and it does not contain order object, then following method must be overridden by child event class.
	 * Return email
	 * @return bool
	 */
	public function get_email_event() {
		return $this->abandoned_email;
	}

	/**
	 * If any event has user id and it does not contain order object, then following method must be overridden by child event class.
	 * Return user id
	 * @return bool
	 */
	public function get_user_id_event() {
		return $this->user_id;
	}

	public function update_task_meta( $index, $task_id ) {
		BWFAN_Core()->tasks->insert_taskmeta( $task_id, 'c_a_id', $this->abandoned_id );
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
		?>

        <li>
            <strong><?php esc_html_e( 'Abandoned Email:', 'wp-marketing-automations' ); ?> </strong>
			<?php echo "<a href='" . site_url( 'wp-admin/admin.php?page=autonami&path=/carts/recoverable/' . $global_data['cart_abandoned_id'] . '/tasks' ) . "'>" . esc_html( $global_data['email'] ) . '</a>'; //phpcs:ignore WordPress.Security.EscapeOutput ?>
        </li>
		<?php
		if ( isset( $global_data['phone'] ) && ! empty( $global_data['phone'] ) ) { ?>
            <li>
                <strong><?php esc_html_e( 'Abandoned Phone:', 'wp-marketing-automations' ); ?> </strong>
				<?php echo $global_data['phone']; //phpcs:ignore WordPress.Security.EscapeOutput ?>
            </li>
			<?php
		}

		return ob_get_clean();
	}

	public function validate_event( $task_details ) {
		$cart_id   = $task_details['processed_data']['cart_abandoned_id'];
		$cart_data = BWFAN_Model_Abandonedcarts::get( $cart_id );

		$email = is_email( $cart_data['email'] ) ? $cart_data['email'] : $task_details['processed_data']['email'];
		if ( ! is_email( $email ) ) {
			return $this->get_automation_event_success();
		}

		/** If order is pending or failed then cart is valid so continue */
		$orders = wc_get_orders( array(
			'billing_email' => $email,
			'date_after'    => $cart_data['created_time'],
		) );

		/** empty orders than return **/
		if ( empty( $orders ) ) {
			return $this->get_automation_event_success();
		}

		$orders = array_filter( $orders, function ( $order ) {
			$failed_statuses = [ 'pending', 'failed', 'cancelled', 'trash' ];
			if ( ! in_array( $order->get_status(), $failed_statuses, true ) ) {
				return true;
			}

			return false;
		} );

		if ( empty( $orders ) ) {
			return $this->get_automation_event_success();
		}

		/** in case order is not an instance than return success **/
		if ( ! $orders[0] instanceof WC_Order ) {
			return $this->get_automation_event_success();
		}

		/** Order is placed, discard the task execution */
		$automation_id = $task_details['processed_data']['automation_id'];

		/** Attributing the sale */
		$orders[0]->update_meta_data( '_bwfan_ab_cart_recovered_a_id', $automation_id );

		$task_data_meta = BWFAN_Model_Tasks::get_task_with_data( $task_details['task_id'] );
		$track_id       = $task_data_meta['meta']['t_track_id'];
		if ( ! empty( $track_id ) ) {
			$orders[0]->update_meta_data( '_bwfan_ab_cart_recovered_t_id', $track_id );
		}

		$orders[0]->update_meta_data( '_bwfan_recovered_ab_id', $cart_id );
		$orders[0]->save_meta_data();

		$cart_tasks = BWFAN_Common::get_schedule_task_by_email( [ $automation_id ], $cart_data['email'] );
		$cart_tasks = $cart_tasks[ $automation_id ];

		$cart_tasks = array_map( function ( $v ) {
			return $v['ID'];
		}, $cart_tasks );

		$fail_resp = array(
			'status'  => 4,
			'message' => 'Cart is recovered already',
		);

		if ( empty( $cart_tasks ) ) {
			BWFAN_Model_Abandonedcarts::delete( $cart_id );

			return $fail_resp;
		}

		/** Delete the tasks */

		global $wpdb;
		$tasks_count = count( $cart_tasks );

		if ( in_array( $task_details['task_id'], $cart_tasks ) ) {
			$cart_tasks = array_diff( $cart_tasks, [ $task_details['task_id'] ] );
			sort( $cart_tasks );
			$tasks_count = count( $cart_tasks );
		}

		$prepare_placeholders = array_fill( 0, $tasks_count, '%d' );
		$prepare_placeholders = implode( ', ', $prepare_placeholders );

		/** Delete Tasks */
		$sql_query = "DELETE FROM {table_name} WHERE `ID` IN ($prepare_placeholders)";
		$sql_query = $wpdb->prepare( $sql_query, $cart_tasks ); // WPCS: unprepared SQL OK
		BWFAN_Model_Tasks::query( $sql_query );

		/** Delete Tasks Meta */
		$sql_query = "Delete FROM {table_name} WHERE `bwfan_task_id` IN ($prepare_placeholders)";
		$sql_query = $wpdb->prepare( $sql_query, $cart_tasks ); // WPCS: unprepared SQL OK
		BWFAN_Model_Taskmeta::query( $sql_query );

		/** Delete the cart */
		BWFAN_Model_Abandonedcarts::delete( $cart_id );

		return $fail_resp;
	}

	/**
	 * Set global data for all the merge tags which are supported by this event.
	 *
	 * @param $task_meta
	 */
	public function set_merge_tags_data( $task_meta ) {
		$cart_abandoned_id = BWFAN_Merge_Tag_Loader::get_data( 'cart_abandoned_id' );
		if ( empty( $cart_abandoned_id ) || $cart_abandoned_id !== $task_meta['global']['cart_abandoned_id'] ) {
			$set_data = array(
				'cart_abandoned_id' => $task_meta['global']['cart_abandoned_id'],
				'email'             => $task_meta['global']['email'],
				'cart_details'      => BWFAN_Model_Abandonedcarts::get( $task_meta['global']['cart_abandoned_id'] ),
			);
			BWFAN_Merge_Tag_Loader::set_data( $set_data );
		}
	}

	/**
	 * checking if the abandoned cart contain empty cart
	 */
	public function validate_event_data_before_executing_task( $data ) {
		return $this->validate_cart_details( $data );
	}

	/** validating abandoned cart contain item or not
	 *
	 * @param $data
	 *
	 * @return bool
	 */
	public function validate_cart_details( $data ) {
		if ( ! isset( $data['cart_abandoned_id'] ) ) {
			return false;
		}

		$cart_data = BWFAN_Model_Abandonedcarts::get( $data['cart_abandoned_id'] );
		if ( empty( $cart_data ) ) {
			return false;
		}
		$cart_items = maybe_unserialize( $cart_data['items'] );

		if ( empty( $cart_items ) ) {
			$this->message_validate_event = __( 'Cart does not contain any item.', 'wp-marketing-automations' );

			return false;
		}

		return true;
	}

	public function validate_v2_event_settings( $automation_data ) {
		if ( ! isset( $automation_data['abandoned_id'] ) ) {
			return false;
		}

		$cart_data = BWFAN_Model_Abandonedcarts::get( $automation_data['abandoned_id'] );
		if ( empty( $cart_data ) ) {
			return false;
		}
		$cart_items = maybe_unserialize( $cart_data['items'] );
		if ( empty( $cart_items ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Before starting automation on a contact, validating if cart row exists
	 *
	 * @param $row
	 *
	 * @return bool
	 */
	public function validate_v2_before_start( $row ) {
		if ( empty( $row['data'] ) ) {
			return false;
		}
		$data = json_decode( $row['data'], true );
		if ( ! isset( $data['global'] ) || ! isset( $data['global']['cart_abandoned_id'] ) ) {
			return false;
		}

		$goal_checking = BWFAN_Common::is_wc_order_goal( $data['global']['automation_id'] );
		if ( $goal_checking ) {
			return true;
		}

		$cart_id   = $data['global']['cart_abandoned_id'];
		$cart_data = BWFAN_Model_Abandonedcarts::get( $cart_id );
		if ( empty( $cart_data ) ) {
			return false;
		}

		$orders = wc_get_orders( array(
			'billing_email' => $cart_data['email'],
			'date_after'    => $cart_data['created_time'],
		) );
		if ( empty( $orders ) ) {
			return true;
		}

		$orders = array_filter( $orders, function ( $order ) {
			return ! ( in_array( $order->get_status(), [ 'pending', 'failed', 'cancelled', 'trash' ], true ) );
		} );
		if ( empty( $orders ) ) {
			return true;
		}

		/** Delete abandoned cart  */
		BWFAN_Model_Abandonedcarts::delete( $cart_id );

		return false;
	}

	/**
	 * get contact automation data
	 *
	 * @param $automation_data
	 * @param $cid
	 *
	 * @return array|null[]
	 */
	public function get_manually_added_contact_automation_data( $automation_data, $cid ) {
		$contact = new BWFCRM_Contact( $cid );
		if ( ! $contact->is_contact_exists() ) {
			return [ 'status' => 0, 'type' => 'contact_not_found' ];
		}
		$email = $contact->contact->get_email();
		$cart  = BWFAN_Model_Abandonedcarts::get_abandoned_data( " WHERE `email`='$email' ", '', '', 'ID', ARRAY_A );
		if ( empty( $cart ) ) {
			return [ 'status' => 0, 'type' => '', 'message' => "Contact doesn't have any tracked cart." ];
		}

		$this->abandoned_id    = $cart[0]['ID'];
		$this->abandoned_email = $email;
		$this->abandoned_data  = $cart[0];
		$data                  = array(
			'abandoned_id' => absint( $this->abandoned_id ),
			'email'        => $this->abandoned_email,
			'user_id'      => $this->user_id,
			'cart_item'    => $this->abandoned_data['items'],
		);

		return array_merge( $automation_data, $data );
	}

	/**
	 * @return bool|void
	 */
	public static function maybe_clean() {
		$duplicate_entries = BWFAN_Model_Abandonedcarts::get_duplicate_entry();
		if ( empty( $duplicate_entries ) ) {
			return;
		}

		global $wpdb;
		$string_placeholder = array_fill( 0, count( $duplicate_entries ), '%d' );
		$placeholder        = implode( ', ', $string_placeholder );

		$query = $wpdb->prepare( "DELETE FROM `{$wpdb->prefix}bwfan_abandonedcarts` WHERE `ID` IN ({$placeholder})", $duplicate_entries );

		return ( $wpdb->query( $query ) > 0 ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
	}
}

/**
 * Register this event to a source.
 * This will show the current event in dropdown in single automation screen.
 */
if ( bwfan_is_woocommerce_active() ) {
	return 'BWFAN_AB_Cart_Abandoned';
}
