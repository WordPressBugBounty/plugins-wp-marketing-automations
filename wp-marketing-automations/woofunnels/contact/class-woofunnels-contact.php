<?php
/**
 * Contact Class
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WooFunnels_Contact' ) ) {
	/**
	 * Class WooFunnels_Contact
	 *
	 *
	 */
	#[AllowDynamicProperties]
	class WooFunnels_Contact {
		/**
		 * @var WooFunnels_DB_Operations
		 */
		public $db_operations;

		/**
		 * public id $id
		 */
		public $id;

		/**
		 * public ud $uid
		 */
		public $uid;

		/**
		 * public email $email
		 */
		public $email;

		/**
		 * public wp_id $wp_id
		 */
		public $wp_id;

		/**
		 * public meta $meta
		 */
		public $meta;

		/**
		 * public customer $customer
		 */
		public $children;


		/**
		 * @var mixed $db_contact
		 */
		public $db_contact;

		/**
		 * @var bool $blank_values_update
		 */
		public $blank_values_update = false;

		public $is_subscribed = false;

		/**
		 * Get the contact details for the email passed if this email exits other create a new contact with this email
		 *
		 * @param string|int $wp_id WordPress User ID
		 * @param string $email email
		 * @param string $phone contact number
		 * @param string|int $cid contact id,
		 * @param string $uid Unique ID
		 */
		public function __construct( $wp_id = '', $email = '', $phone = '', $cid = '', $uid = '' ) {
			/** Set blank properties */
			$this->set_blank_props();

			$this->email = $email;
			$this->wp_id = $wp_id;

			/** If CID given */
			if ( ! empty( $cid ) && absint( $cid ) > 0 ) {
				$this->db_contact = $this->get_contact_by_id( absint( $cid ) );

				$db_obj = $this->validate_and_set_obj( $this->db_contact );

				if ( false !== $db_obj ) {
					return;
				}
			}

			/** If WP ID given */
			if ( ! empty( $wp_id ) && absint( $wp_id ) > 0 ) {
				$this->db_contact = $this->get_contact_by_wpid( absint( $wp_id ) );

				$db_obj = $this->validate_and_set_obj( $this->db_contact );

				if ( false !== $db_obj ) {
					return;
				}
			}

			/** If EMAIL given */
			if ( ! empty( $email ) && is_email( $email ) ) {
				$this->db_contact = $this->get_contact_by_email( trim( $email ) );

				$db_obj = $this->validate_and_set_obj( $this->db_contact );

				if ( false !== $db_obj ) {
					return;
				}
			}

			/** If PHONE given */
			if ( ! empty( $phone ) ) {
				$this->db_contact = $this->get_contact_by_phone( trim( $phone ) );

				$db_obj = $this->validate_and_set_obj( $this->db_contact );

				if ( false !== $db_obj ) {
					return;
				}
			}

			/** If UID given */
			if ( ! empty( $uid ) ) {
				$this->db_contact = $this->get_contact_by_uid( trim( $uid ) );

				$this->validate_and_set_obj( $this->db_contact );
			}
		}

		public function set_blank_props() {
			$this->db_operations = WooFunnels_DB_Operations::get_instance();

			if ( ! isset( $this->children ) ) {
				$this->children = new stdClass();
			}

			if ( ! isset( $this->meta ) ) {
				$this->meta = new stdClass();
			}

			$this->db_contact = new stdClass();
		}

		/**
		 * Get contact by id i.e. cid
		 *
		 * @param $cid
		 *
		 * @return mixed
		 */
		public function get_contact_by_id( $cid ) {
			$cached_obj = $this->get_cache_obj( 'cid', $cid );
			if ( false !== $cached_obj ) {
				return $cached_obj;
			}

			$output = $this->db_operations->get_contact_by_contact_id( $cid );

			$this->set_cache_object( 'cid', $cid, $output );

			return $output;
		}

		/**
		 * Get contact cache object
		 *
		 * @param $type
		 * @param $value
		 *
		 * @return false|mixed
		 */
		public function get_cache_obj( $type, $value ) {
			$obj   = BWF_Contacts::get_instance();
			$value = sanitize_key( $value );

			if ( isset( $obj->cached_contact_obj[ $type ] ) && isset( $obj->cached_contact_obj[ $type ][ $value ] ) ) {
				return $obj->cached_contact_obj[ $type ][ $value ];
			}

			return false;
		}

		/**
		 * Set contact cache object
		 *
		 * @param $type
		 * @param $value
		 * @param $output
		 */
		public function set_cache_object( $type, $value, $output ) {
			$obj   = BWF_Contacts::get_instance();
			$value = sanitize_key( $value );

			if ( ! isset( $obj->cached_contact_obj[ $type ] ) ) {
				$obj->cached_contact_obj[ $type ] = [];
			}

			$obj->cached_contact_obj[ $type ][ $value ] = $output;
		}

		public function validate_and_set_obj( $obj ) {
			if ( ! is_object( $obj ) || ! isset( $obj->id ) ) {
				return false;
			}
			$this->id    = $obj->id;
			$this->email = $this->db_contact->email;
			$this->wp_id = $this->db_contact->wpid;

			$this->set_obj_meta();

			return true;
		}

		public function set_obj_meta() {
			if ( ! isset( $this->id ) || empty( $this->id ) ) {
				return;
			}

			$contact_meta = $this->db_operations->get_contact_metadata( $this->id );
			foreach ( is_array( $contact_meta ) ? $contact_meta : array() as $meta ) {
				$this->meta->{$meta->meta_key} = maybe_unserialize( $meta->meta_value );
			}
		}

		/**
		 * Get contact by wp_id
		 *
		 * @param $wp_id
		 *
		 * @return mixed
		 */
		public function get_contact_by_wpid( $wp_id ) {
			$cached_obj = $this->get_cache_obj( 'wp_id', $wp_id );
			if ( false !== $cached_obj ) {
				return $cached_obj;
			}

			$output = $this->db_operations->get_contact_by_wpid( $wp_id );

			$this->set_cache_object( 'wp_id', $wp_id, $output );

			return $output;
		}

		/**
		 * Get contact by email
		 *
		 * @param $email
		 *
		 * @return mixed
		 */
		public function get_contact_by_email( $email ) {
			$cached_obj = $this->get_cache_obj( 'email', $email );
			if ( false !== $cached_obj ) {
				return $cached_obj;
			}

			$output = $this->db_operations->get_contact_by_email( $email );

			$this->set_cache_object( 'email', $email, $output );

			return $output;
		}

		/**
		 * Get contact by phone
		 *
		 * @param $phone
		 *
		 * @return mixed
		 */
		public function get_contact_by_phone( $phone ) {
			$cached_obj = $this->get_cache_obj( 'phone', $phone );
			if ( false !== $cached_obj ) {
				return $cached_obj;
			}

			$output = $this->db_operations->get_contact_by_phone( $phone );

			$this->set_cache_object( 'phone', $phone, $output );

			return $output;
		}

		public function get_contact_by_uid( $uid ) {
			$cached_obj = $this->get_cache_obj( 'uid', $uid );
			if ( false !== $cached_obj ) {
				return $cached_obj;
			}

			$output = $this->db_operations->get_contact( $uid );

			$this->set_cache_object( 'uid', $uid, $output );

			return $output;
		}

		/**
		 * Implementing magic function for calling other contact's actor(like customer) functions
		 *
		 * @param $name
		 * @param $args
		 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
		 *
		 * @return mixed
		 */
		public function __call( $name, $args ) {
			$keys_arr       = explode( '_', $name );
			$action         = ( is_array( $keys_arr ) && count( $keys_arr ) > 0 ) ? $keys_arr[0] : '';
			$child          = ( is_array( $keys_arr ) && count( $keys_arr ) > 1 ) ? $keys_arr[1] : '';
			$function       = str_replace( $child . '_', '', $name );
			$child_entities = BWF_Contacts::get_registerd_child_entities();

			if ( 'set_child' === $function && ! isset( $this->children->{$child} ) ) {
				if ( isset( $child_entities[ $child ] ) ) {
					$object_child             = $child_entities[ $child ];
					$this->children->{$child} = new $object_child( $this );
				}
			} elseif ( isset( $this->children ) && ! empty( $this->children ) && ! empty( $child ) && isset( $this->children->{$child} ) && 'set_child' !== $function ) {
				$result = '';
				if ( is_array( $args ) && count( $args ) > 0 ) {
					$result = $this->children->{$child}->{$function}( $args[0] );
				}

				if ( ! is_array( $args ) || ( is_array( $args ) && 0 === count( $args ) ) ) {
					$result = $this->children->{$child}->{$function}();
				}
				if ( 'get' === $action ) {
					return $result;
				}
			} elseif ( ! isset( $this->children->{$child} ) ) {
				BWF_Logger::get_instance()->log( "Magic Function $name is not defined for child function: $function", 'woofunnels_indexing' );
			}
		}

		/**
		 * Get marketing status
		 */
		public function get_marketing_status() {
			return $this->get_status();
		}

		/**
		 * Get marketing status
		 */
		public function get_status() {
			$status = ( isset( $this->status ) && '' !== $this->status ) ? $this->status : '';

			$db_status = ( isset( $this->db_contact->status ) && '' !== $this->db_contact->status ) ? $this->db_contact->status : '';

			return '' !== $status ? $status : $db_status;
		}

		/**
		 * Get meta value for a given meta key from current contact object
		 *
		 * @param string $meta_key meta key to get value against
		 * @param bool $is_primary_column_check whether to check primary properties or not
		 *
		 * @return mixed|string
		 */
		public function get_meta( $meta_key, $is_primary_column_check = true ) {

			if ( $is_primary_column_check ) {
				$primary_columns = $this->get_primary_properties();
				if ( in_array( $meta_key, $primary_columns, true ) ) {
					return call_user_func( array( $this, 'get_' . $meta_key ) );
				}
			}
			if ( isset( $this->meta->{$meta_key} ) ) {
				return maybe_unserialize( $this->meta->{$meta_key} );
			}

			return '';
		}

		/**
		 * @param $meta_key
		 * @param $meta_value
		 */
		public function set_meta( $meta_key, $meta_value ) {
			$this->meta->{$meta_key} = $meta_value;
		}

		/**
		 * @param $meta_key
		 */
		public function unset_meta( $meta_key ) {
			if ( isset( $this->meta ) && isset( $this->meta->{$meta_key} ) ) {
				unset( $this->meta->{$meta_key} );
			}
		}

		public function get_primary_properties() {
			return array(
				'id',
				'email',
				'wpid',
				'uid',
				'email',
				'f_name',
				'l_name',
				'creation_date',
				'contact_no',
				'country',
				'state',
				'timezone',
				'type',
				'source',
				'points',
				'last_modified',
				'status',
				'tags',
				'lists'
			);
		}

		/**
		 * Set contact first name
		 *
		 * @param $f_name
		 */
		public function set_f_name( $f_name ) {
			if ( true === $this->blank_values_update ) {
				$this->f_name = $f_name;
				if ( ! empty( $this->f_name ) ) {
					$this->f_name = trim( $this->f_name );
				}

				return;
			}
			$this->f_name = empty( $f_name ) ? $this->get_f_name() : $f_name;
			if ( ! empty( $this->f_name ) ) {
				$this->f_name = trim( $this->f_name );
			}
		}

		/**
		 * Get contact first name
		 */
		public function get_f_name() {
			$f_name = ( isset( $this->f_name ) ) ? $this->f_name : null;
			if ( ! empty( $f_name ) ) {
				$f_name = trim( $f_name );
			}
			$db_f_name = ( isset( $this->db_contact->f_name ) ) ? $this->db_contact->f_name : '';
			if ( ! empty( $db_f_name ) ) {
				$db_f_name = trim( $db_f_name );
			}

			return is_null( $f_name ) ? $db_f_name : $f_name;
		}

		/**
		 * Set contact last name
		 *
		 * @param $l_name
		 */
		public function set_l_name( $l_name ) {
			if ( true === $this->blank_values_update ) {
				$this->l_name = $l_name;
				if ( ! empty( $this->l_name ) ) {
					$this->l_name = trim( $this->l_name );
				}

				return;
			}
			$this->l_name = empty( $l_name ) ? $this->get_l_name() : $l_name;
			if ( ! empty( $this->l_name ) ) {
				$this->l_name = trim( $this->l_name );
			}
		}

		/**
		 * Get contact last name
		 */
		public function get_l_name() {
			$l_name = ( isset( $this->l_name ) ) ? $this->l_name : null;
			if ( ! empty( $l_name ) ) {
				$l_name = trim( $l_name );
			}
			$db_l_name = ( isset( $this->db_contact->l_name ) ) ? $this->db_contact->l_name : '';
			if ( ! empty( $db_l_name ) ) {
				$db_l_name = trim( $db_l_name );
			}

			return is_null( $l_name ) ? $db_l_name : $l_name;
		}

		/**
		 * Set contact tags
		 *
		 * @param string[] $tags
		 */
		public function set_tags( $tags ) {
			if ( ! is_array( $tags ) ) {
				return;
			}

			$this->tags = wp_json_encode( array_map( 'strval', $tags ) );
		}

		/**
		 * Get contact tags
		 */
		public function get_tags() {
			$tags    = ( isset( $this->tags ) && ! empty( $this->tags ) ) ? json_decode( $this->tags, true ) : null;
			$db_tags = ( isset( $this->db_contact->tags ) && ! empty( $this->db_contact->tags ) ) ? json_decode( $this->db_contact->tags, true ) : null;
			$db_tags = ! is_array( $db_tags ) ? [] : $db_tags;

			return ! is_array( $tags ) ? $db_tags : $tags;
		}

		/**
		 * Set contact lists
		 *
		 * @param string[] $lists
		 */
		public function set_lists( $lists ) {
			if ( ! is_array( $lists ) ) {
				return;
			}

			$this->lists = wp_json_encode( array_map( 'strval', $lists ) );
		}

		/**
		 * Get contact lists
		 */
		public function get_lists() {
			$lists    = ( isset( $this->lists ) && ! empty( $this->lists ) ) ? json_decode( $this->lists, true ) : null;
			$db_lists = ( isset( $this->db_contact->lists ) && ! empty( $this->db_contact->lists ) ) ? json_decode( $this->db_contact->lists, true ) : null;
			$db_lists = ! is_array( $db_lists ) ? [] : $db_lists;

			return ! is_array( $lists ) ? $db_lists : $lists;
		}

		/**
		 * Set contact created date
		 *
		 * @param $date
		 */
		public function set_last_modified( $date ) {
			$this->last_modified = empty( $date ) ? $this->get_last_modified() : $date;
		}

		/**
		 * Get contact fname
		 */
		public function get_last_modified() {
			$last_mod         = ( isset( $this->last_modified ) && ! empty( $this->last_modified ) ) ? $this->last_modified : '';
			$db_last_modified = ( isset( $this->db_contact->last_modified ) && ! empty( $this->db_contact->last_modified ) ) ? $this->db_contact->last_modified : '';

			return empty( $last_mod ) ? $db_last_modified : $last_mod;
		}

		/**
		 * Set contact created date
		 *
		 * @param $date
		 */
		public function set_creation_date( $date ) {
			$this->creation_date = empty( $date ) ? $this->get_creation_date() : $date;
		}

		/**
		 * Get contact created date
		 */
		public function get_creation_date() {
			$creation_date    = ( isset( $this->creation_date ) && ! empty( $this->creation_date ) ) ? $this->creation_date : '';
			$db_creation_date = ( isset( $this->db_contact->creation_date ) && ! empty( $this->db_contact->creation_date ) ) ? $this->db_contact->creation_date : current_time( 'mysql' );

			return empty( $creation_date ) ? $db_creation_date : $creation_date;
		}

		public function set_type( $type ) {
			$this->type = empty( $type ) ? $this->get_type() : $type;
		}

		/**
		 * Get type the contact belongs to
		 * @return string
		 */
		public function get_type() {
			$type    = ( isset( $this->type ) && ! empty( $this->type ) ) ? $this->type : '';
			$db_type = ( isset( $this->db_contact->type ) && ! empty( $this->db_contact->type ) ) ? $this->db_contact->type : '';

			return empty( $type ) ? $db_type : $type;
		}

		public function set_source( $source ) {
			$this->source = empty( $source ) ? $this->get_source() : $source;
		}

		/**
		 * Get source the contact generated from
		 * @return string
		 */
		public function get_source() {
			$source    = ( isset( $this->source ) && ! empty( $this->source ) ) ? $this->source : '';
			$db_source = ( isset( $this->db_contact->source ) && ! empty( $this->db_contact->source ) ) ? $this->db_contact->source : '';

			return empty( $source ) ? $db_source : $source;
		}

		public function set_points( $points ) {
			$this->points = empty( $points ) ? 0 : $points;
		}

		/**
		 * Get points the contact have
		 * @return integer
		 */
		public function get_points() {
			return ( isset( $this->points ) && intval( $this->points ) > 0 ) ? intval( $this->points ) : 0;
		}

		/**
		 * Saves the data in the properties.
		 * This method is responsible for any db operation inside the contact table and sibling tables
		 * Updating contact table with set data
		 *
		 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
		 * @SuppressWarnings(PHPMD.DevelopmentCodeFragment)
		 *
		 */
		public function save() {
			$contact = array();

			$get_primary_properties = $this->get_primary_properties();
			foreach ( $get_primary_properties as $property ) {
				$contact[ $property ] = call_user_func( array( $this, 'get_' . $property ) );
				if ( 'tags' === $property || 'lists' === $property ) {
					$contact[ $property ] = wp_json_encode( $contact[ $property ] );
				}
			}

			$contact['last_modified'] = current_time( 'mysql' );

			if ( $this->get_id() > 0 ) {
				/** Existing contact */
				$contact['id'] = $this->get_id();

				/** Check if UID empty */
				if ( empty( $this->get_uid() ) ) {
					$contact['uid'] = md5( $this->email . $this->wp_id . time() );
					$this->set_uid( $contact['uid'] );
				}

				$this->db_operations->update_contact( $contact );
			} elseif ( empty( $this->get_id() ) ) {
				$contact['uid']  = md5( $this->email . $this->wp_id . time() );
				$contact['wpid'] = $this->get_wpid() > 0 ? $this->get_wpid() : 0;
				$this->set_uid( $contact['uid'] );
				$contact_id = $this->db_operations->insert_contact( $contact );

				$this->id = $contact_id;
			}

			/** Run subscribe action */
			if ( true === $this->is_subscribed ) {
				do_action( 'bwfcrm_after_contact_subscribed', $this );
				$this->is_subscribed = false;
			}

			/** Purge Cache */
			$this->purge_contact_from_cache();

			if ( isset( $this->children ) && ! empty( $this->children ) ) {
				foreach ( $this->children as $child_actor ) {
					$child_actor->set_cid( $this->get_id() );
					$child_actor->save();
				}
			}
		}

		/**
		 * Get contact id
		 * @SuppressWarnings(PHPMD.ShortVariable)
		 */
		public function get_id() {
			$id    = ( isset( $this->id ) && $this->id > 0 ) ? $this->id : 0;
			$db_id = ( isset( $this->db_contact->id ) && ( $this->db_contact->id > 0 ) ) ? $this->db_contact->id : 0;

			return ( $id > 0 ) ? $id : $db_id;
		}

		/**
		 * Set contact id
		 *
		 * @param $id
		 */
		public function set_id( $id ) {
			$this->id = empty( $id ) ? $this->get_id() : $id;
		}

		/**
		 * Get contact wp_id
		 */
		public function get_wpid() {
			return ( isset( $this->wp_id ) && intval( $this->wp_id ) > 0 ) ? intval( $this->wp_id ) : 0;
		}

		/**
		 * Set contact wp id
		 *
		 * @param $wp_id
		 */
		public function set_wpid( $wp_id ) {
			$this->wp_id = intval( $wp_id );
		}

		/**
		 * Purge contact sql object from cache
		 */
		public function purge_contact_from_cache() {
			$obj = BWF_Contacts::get_instance();

			$cid   = sanitize_key( $this->get_id() );
			$email = sanitize_key( $this->get_email() );
			$phone = sanitize_key( $this->get_contact_no() );
			$wp_id = sanitize_key( $this->get_wpid() );
			$uid   = sanitize_key( $this->get_uid() );

			/** cid */
			if ( isset( $obj->cached_contact_obj['cid'] ) && isset( $obj->cached_contact_obj['cid'][ $cid ] ) ) {
				unset( $obj->cached_contact_obj['cid'][ $cid ] );
			}

			/** email */
			if ( isset( $obj->cached_contact_obj['email'] ) && isset( $obj->cached_contact_obj['email'][ $email ] ) ) {
				unset( $obj->cached_contact_obj['email'][ $email ] );
			}

			/** phone */
			if ( isset( $obj->cached_contact_obj['phone'] ) && isset( $obj->cached_contact_obj['phone'][ $phone ] ) ) {
				unset( $obj->cached_contact_obj['phone'][ $phone ] );
			}

			/** wp id */
			if ( isset( $obj->cached_contact_obj['wp_id'] ) && isset( $obj->cached_contact_obj['wp_id'][ $wp_id ] ) ) {
				unset( $obj->cached_contact_obj['wp_id'][ $wp_id ] );
			}

			/** uid */
			if ( isset( $obj->cached_contact_obj['uid'] ) && isset( $obj->cached_contact_obj['uid'][ $uid ] ) ) {
				unset( $obj->cached_contact_obj['uid'][ $uid ] );
			}
		}

		/**
		 * Get contact email
		 */
		public function get_email() {
			$email = ( isset( $this->email ) && ! empty( $this->email ) ) ? $this->email : '';
			if ( ! empty( $email ) ) {
				$email = trim( $email );
			}
			$db_email = ( isset( $this->db_contact->email ) && ! empty( $this->db_contact->email ) ) ? $this->db_contact->email : '';
			if ( ! empty( $db_email ) ) {
				$db_email = trim( $db_email );
			}

			return empty( $email ) ? $db_email : $email;
		}

		/**
		 * Set contact email
		 *
		 * @param $email
		 */
		public function set_email( $email ) {
			$this->email = empty( $email ) ? $this->get_email() : $email;
			if ( ! empty( $this->email ) ) {
				$this->email = trim( $this->email );
			}
		}

		public function get_contact_no() {
			$contact_no    = ( isset( $this->contact_no ) ) ? $this->contact_no : null;
			$db_contact_no = ( isset( $this->db_contact->contact_no ) ) ? $this->db_contact->contact_no : '';

			return is_null( $contact_no ) ? $db_contact_no : $contact_no;
		}

		/**
		 * Get contact uid
		 */
		public function get_uid() {
			$uid = ( isset( $this->uid ) && ! empty( $this->uid ) ) ? $this->uid : '';

			$db_uid = ( isset( $this->db_contact->uid ) && ! empty( $this->db_contact->uid ) ) ? $this->db_contact->uid : '';

			return empty( $uid ) ? $db_uid : $uid;
		}

		/**
		 * Set contact uid
		 *
		 * @param $uid
		 */
		public function set_uid( $uid ) {
			$this->uid = empty( $uid ) ? $this->get_uid() : $uid;
		}

		/**
		 * Get meta value for a given meta key from DB
		 */
		public function get_contact_meta( $meta_key ) {
			return $this->db_operations->get_contact_meta_value( $this->get_id(), $meta_key );
		}

		/**
		 * Set meta value for a given meta key
		 *
		 * @param $meta_key
		 * @param $meta_value
		 *
		 * @return mixed
		 */
		public function update_meta( $meta_key, $meta_value ) {
			return $this->db_operations->update_contact_meta( $this->get_id(), $meta_key, $meta_value );
		}

		/**
		 * Updating contact meta table with set data
		 */
		public function save_meta() {
			$this->db_operations->save_contact_meta( $this->id, $this->meta );
			$contact                  = [];
			$contact['id']            = $this->get_id();
			$contact['last_modified'] = current_time( 'mysql' );
			$this->db_operations->update_contact( $contact );
		}

		/**
		 * Set marketing status
		 *
		 * @param $status
		 */
		public function set_marketing_status( $status ) {
			$this->set_status( $status );
		}

		/**
		 * Set marketing status
		 *
		 * @param $status
		 */
		public function set_status( $status ) {

			/** If cid 0 */
			if ( 0 === absint( $this->get_id() ) ) {
				/** New contact */
				/** Check if status is subscribed */
				if ( 1 === absint( $status ) ) {
					/** run do action contact subscribed */
					$this->is_subscribed = true;
				}
			} else {
				$old_status = $this->get_status();
				if ( 1 !== absint( $old_status ) && 1 === absint( $status ) ) {
					/** run do action contact subscribed */
					$this->is_subscribed = true;
				}
			}


			$this->status = ( '' === $status ) ? $this->get_status() : $status;
		}

		/**
		 * Set contact country
		 *
		 * @param $country
		 */
		public function set_country( $country ) {
			if ( true === $this->blank_values_update ) {
				$this->country = $country;

				return;
			}
			$this->country = empty( $country ) ? $this->get_country() : $country;
		}

		/**
		 * Get contact country
		 */
		public function get_country() {
			$country    = ( isset( $this->country ) ) ? $this->country : null;
			$db_country = ( isset( $this->db_contact->country ) ) ? $this->db_contact->country : '';

			return is_null( $country ) ? $db_country : $country;
		}

		/**
		 * Set contact timezone
		 *
		 * @param $timezone
		 */
		public function set_timezone( $timezone ) {
			if ( true === $this->blank_values_update ) {
				$this->timezone = $timezone;

				return;
			}
			$this->timezone = empty( $timezone ) ? $this->get_timezone() : $timezone;
		}

		/**
		 * Get contact timezone
		 *
		 * @return string
		 */
		public function get_timezone() {
			$timezone    = ( isset( $this->timezone ) ) ? $this->timezone : null;
			$db_timezone = ( isset( $this->db_contact->timezone ) ) ? $this->db_contact->timezone : '';

			return is_null( $timezone ) ? $db_timezone : $timezone;
		}

		/**
		 * Set contact number
		 *
		 * @param $contact_no
		 */
		public function set_contact_no( $contact_no ) {
			if ( true === $this->blank_values_update ) {
				$this->contact_no = $contact_no;

				return;
			}
			$this->contact_no = empty( $contact_no ) ? $this->get_contact_no() : $contact_no;
		}

		/**
		 * Set contact state
		 *
		 * @param $state
		 */
		public function set_state( $state ) {
			if ( true === $this->blank_values_update ) {
				$this->state = $state;

				return;
			}
			$this->state = empty( $state ) ? $this->get_state() : $state;
		}

		/**
		 * Get contact state
		 */
		public function get_state() {
			$state    = ( isset( $this->state ) ) ? $this->state : null;
			$db_state = ( isset( $this->db_contact->state ) ) ? $this->db_contact->state : '';

			return is_null( $state ) ? $db_state : $state;
		}

		/**
		 * Deleting a meta key from contact meta table
		 *
		 * @param $meta_key
		 */
		public function delete_meta( $meta_key ) {
			$this->db_operations->delete_contact_meta( $this->id, $meta_key );
		}
	}
}