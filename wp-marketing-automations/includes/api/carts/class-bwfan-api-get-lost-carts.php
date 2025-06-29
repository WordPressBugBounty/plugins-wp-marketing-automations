<?php

class BWFAN_API_Get_Lost_Carts extends BWFAN_API_Base {
	public static $ins;

	public static function get_instance() {
		if ( null === self::$ins ) {
			self::$ins = new self();
		}

		return self::$ins;
	}

	public $total_count = 0;
	public $count_data = [];

	public function __construct() {
		parent::__construct();
		$this->method             = WP_REST_Server::READABLE;
		$this->route              = '/carts/lost/';
		$this->pagination->offset = 0;
		$this->pagination->limit  = 10;
		$this->request_args       = array(
			'search' => array(
				'description' => __( 'Search from email or checkout page id', 'wp-marketing-automations' ),
				'type'        => 'string',
			),
			'offset' => array(
				'description' => __( 'Lost carts list Offset', 'wp-marketing-automations' ),
				'type'        => 'integer',
			),
			'limit'  => array(
				'description' => __( 'Per page limit', 'wp-marketing-automations' ),
				'type'        => 'integer',
			)
		);
	}

	public function default_args_values() {
		return [
			'search_by' => 'email',
			'search'    => '',
			'offset'    => 0,
			'limit'     => 10
		];
	}

	public function process_api_call() {
		$search_by   = $this->get_sanitized_arg( 'search_by', 'text_field' );
		$search_term = $this->get_sanitized_arg( 'search', 'text_field' );
		$offset      = ! empty( $this->get_sanitized_arg( 'offset', 'text_field' ) ) ? $this->get_sanitized_arg( 'offset', 'text_field' ) : 0;
		$limit       = ! empty( $this->get_sanitized_arg( 'limit', 'text_field' ) ) ? $this->get_sanitized_arg( 'limit', 'text_field' ) : 25;

		$lost_carts = BWFAN_Recoverable_Carts::get_abandoned_carts( $search_by, $search_term, $offset, $limit, 2 );
		if ( isset( $lost_carts['total_count'] ) ) {
			$this->total_count = $lost_carts['total_count'];
			unset( $lost_carts['total_count'] );
		}

		$result  = [];
		$nowDate = new DateTime( 'now', new DateTimeZone( "UTC" ) );
		foreach ( $lost_carts as $item ) {
			$cartDate      = new DateTime( $item->last_modified );
			$diff          = date_diff( $nowDate, $cartDate, true );
			$diff          = BWFAN_Common::get_difference_string( $diff );
			$currency_data = BWFAN_Recoverable_Carts::get_currency( $item );
			$total         = ! is_null( $item->total ) ? $item->total : 0;
			$fee_data      = $this->get_formatted_fee_data( $item->fees );
			$result[]      = [
				'id'            => ! is_null( $item->ID ) ? $item->ID : 0,
				'email'         => ! is_null( $item->email ) ? $item->email : '',
				'phone'         => $this->get_phone( $item ),
				'preview'       => $this->get_preview_data( $item, $fee_data['total'] ),
				'date'          => get_date_from_gmt( $item->last_modified ),
				'created_on'    => get_date_from_gmt( $item->created_time ),
				'status'        => ! is_null( $item->status ) ? $item->status : '',
				'diffstring'    => $diff,
				'items'         => $this->get_items( $item ),
				'fees'          => ! empty( $fee_data['data'] ) ? $fee_data['data'] : [],
				'total'         => $total,
				'currency'      => $currency_data,
				'buyer_name'    => $this->get_order_name( $item ),
				'order_id'      => $this->get_order_id( $item ),
				'user_id'       => ! empty( $item->user_id ) ? $item->user_id : 0,
				'checkout_data' => ! is_null( $item->checkout_data ) ? $item->checkout_data : '',
			];
		}

		$result           = BWFAN_Recoverable_Carts::populate_contact_info( $result );
		$this->count_data = [];

		return $this->success_response( $result, __( 'Lost carts found', 'wp-marketing-automations' ) );
	}

	/**
	 * Get formatted fee data
	 *
	 * @param $data
	 *
	 * @return array|string
	 */
	public function get_formatted_fee_data( $data ) {
		$fee_data = [
			'data'  => [],
			'total' => 0,
		];
		$data     = maybe_unserialize( $data );
		if ( empty( $data ) || ! is_array( $data ) ) {
			return $fee_data;
		}
		foreach ( $data as $fee ) {
			if ( ! isset( $fee->name ) || empty( $fee->total ) ) {
				continue;
			}

			$amount = floatval( $fee->total );
			if ( ! empty( $fee->tax ) ) {
				$amount += floatval( $fee->tax );
			}

			$fee_data['data'][ ! empty( $fee->name ) ? $fee->name : __( 'Fee', 'wp-marketing-automations' ) ] = $amount;
			$fee_data['total']                                                                                += $amount;
		}

		return $fee_data;
	}

	public function get_result_total_count() {
		return $this->total_count;
	}

	public function get_result_count_data() {
		return $this->count_data;
	}

	public function get_user_display_name( $item ) {
		if ( empty( $item->user_id ) ) {
			return '';
		}
		$user = get_user_by( 'id', absint( $item->user_id ) );

		return $user instanceof WP_User ? $user->display_name : '';
	}

	public function get_phone( $item ) {
		$checkout_data = json_decode( $item->checkout_data, true );

		return ( is_array( $checkout_data ) && isset( $checkout_data['fields'] ) && is_array( $checkout_data['fields'] ) && isset( $checkout_data['fields']['billing_phone'] ) && ! empty( $checkout_data['fields']['billing_phone'] ) ) ? $checkout_data['fields']['billing_phone'] : '';
	}

	public function get_preview_data( $item, $fee_total = 0 ) {
		$data          = array();
		$billing       = array();
		$shipping      = array();
		$others        = array();
		$products      = array();
		$products_data = maybe_unserialize( $item->items );
		$nice_names    = BWFAN_Abandoned_Cart::get_woocommerce_default_checkout_nice_names();
		$checkout_data = json_decode( $item->checkout_data, true );

		if ( is_array( $checkout_data ) && count( $checkout_data ) > 0 ) {
			$fields             = ( isset( $checkout_data['fields'] ) ) ? $checkout_data['fields'] : [];
			$available_gateways = WC()->payment_gateways->payment_gateways();

			if ( ! empty( $fields ) ) {
				foreach ( $fields as $key => $value ) {
					if ( 'billing_phone' === $key ) {
						$others[ $nice_names[ $key ] ] = $value;
						continue;
					}
					if ( false !== strpos( $key, 'billing' ) && isset( $nice_names[ $key ] ) ) {
						$key             = str_replace( 'billing_', '', $key );
						$billing[ $key ] = $value;
						continue;
					}
					if ( false !== strpos( $key, 'shipping' ) && isset( $nice_names[ $key ] ) ) {
						$key              = str_replace( 'shipping_', '', $key );
						$shipping[ $key ] = $value;
						continue;
					}
					if ( 'payment_method' === $key ) {
						if ( isset( $available_gateways[ $value ] ) && 'yes' === $available_gateways[ $value ]->enabled ) {
							$value = $available_gateways[ $value ]->method_title;
						}
						if ( isset( $nice_names[ $key ] ) ) {
							$others[ $nice_names[ $key ] ] = $value;
						}
						continue;
					}
					if ( isset( $nice_names[ $key ] ) ) {
						$others[ $nice_names[ $key ] ] = $value;
					}
				}
			}

			/** Remove WordPress page id in abandoned preview if WordPress page id is same as Aero page id. */
			if ( isset( $checkout_data['current_page_id'] ) && isset( $checkout_data['aerocheckout_page_id'] ) && $checkout_data['current_page_id'] === $checkout_data['aerocheckout_page_id'] ) {
				unset( $checkout_data['current_page_id'] );
			}

			foreach ( $checkout_data as $key => $value ) {
				if ( isset( $nice_names[ $key ] ) ) {
					$others[ $nice_names[ $key ] ] = $value;
				}
			}
		}
		$product_total = floatval( $fee_total );
		if ( is_array( $products_data ) ) {
			$hide_free_products = BWFAN_Common::hide_free_products_cart_order_items();
			foreach ( $products_data as $product ) {
				if ( true === $hide_free_products && empty( $product['line_total'] ) ) {
					continue;
				}
				if ( ! $product['data'] instanceof WC_Product ) {
					continue;
				}
				$products[]    = array(
					'name'  => $product['data']->get_formatted_name(),
					'qty'   => $product['quantity'],
					'price' => number_format( $product['line_subtotal'], 2, '.', '' ),
				);
				$product_total = $product_total + $product['line_subtotal'];
			}
		}

		if ( isset( $billing['country'] ) && isset( $billing['state'] ) ) {
			$country_states = WC()->countries->get_states( $billing['country'] );
			if ( is_array( $country_states ) && isset( $country_states[ $billing['state'] ] ) ) {
				$billing['state'] = $country_states[ $billing['state'] ];
			}
		}

		add_filter( 'woocommerce_formatted_address_force_country_display', '__return_true' );

		$data['billing'] = WC()->countries->get_formatted_address( $billing );
		if ( isset( $shipping['country'] ) && isset( $shipping['state'] ) ) {
			$country_states = WC()->countries->get_states( $shipping['country'] );
			if ( is_array( $country_states ) && isset( $country_states[ $shipping['state'] ] ) ) {
				$shipping['state'] = $country_states[ $shipping['state'] ];
			}
		}

		$data['shipping'] = WC()->countries->get_formatted_address( $shipping );

		add_filter( 'woocommerce_formatted_address_force_country_display', '__return_false' );

		$data['others']   = $others;
		$data['products'] = $products;
		$coupon_data      = maybe_unserialize( $item->coupons );
		$data['currency'] = get_woocommerce_currency_symbol( $item->currency );
		$data['discount'] = 0;

		if ( is_array( $coupon_data ) && 0 !== count( $coupon_data ) ) {
			foreach ( $coupon_data as $key => $coupon ) {
				$data['discount'] += isset( $coupon['discount_incl_tax'] ) ? number_format( $coupon['discount_incl_tax'], 2, '.', '' ) : 0;
			}
		}
		$data['total']          = $product_total - (int) $data['discount'];
		$data['total']          = $data['total'] + $item->shipping_total;
		$data['total']          = ! empty( $data['total'] ) ? number_format( $data['total'], 2, '.', '' ) : 0;
		$data['shipping_total'] = ! empty( $item->shipping_total ) ? number_format( $item->shipping_total, 2, '.', '' ) : 0;

		return $data;
	}

	public function get_items( $item ) {
		$items = maybe_unserialize( $item->items );
		if ( empty( $items ) ) {
			return '';
		}

		$hide_free_products = BWFAN_Common::hide_free_products_cart_order_items();
		$names              = [];
		foreach ( $items as $value ) {
			if ( true === $hide_free_products && empty( $value['line_total'] ) ) {
				continue;
			}
			if ( ! $value['data'] instanceof WC_Product ) {
				continue;
			}
			$names[ $value['data']->get_id() ] = wp_strip_all_tags( $value['data']->get_name() );
		}

		return $names;
	}

	function get_order_name( $item ) {
		if ( 0 === intval( $item->order_id ) ) {
			return '';
		}

		$obj    = wc_get_order( $item->order_id );
		$buyer  = '';
		$output = '';

		if ( ! $obj instanceof WC_Order ) {
			return $output;
		}

		if ( $obj->get_billing_first_name() || $obj->get_billing_last_name() ) {
			/* translators: 1: first name 2: last name */
			$buyer = trim( sprintf( _x( '%1$s %2$s', 'full name', 'woocommerce' ), $obj->get_billing_first_name(), $obj->get_billing_last_name() ) ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch
		} elseif ( $obj->get_billing_company() ) {
			$buyer = trim( $obj->get_billing_company() );
		} elseif ( $obj->get_customer_id() ) {
			$user  = get_user_by( 'id', $obj->get_customer_id() );
			$buyer = ucwords( $user->display_name );
		}

		return apply_filters( 'woocommerce_admin_order_buyer_name', $buyer, $obj );
	}

	function get_order_id( $item ) {
		if ( 0 === intval( $item->order_id ) ) {
			return '';
		}

		$obj = wc_get_order( $item->order_id );
		if ( $obj instanceof WC_Order ) {
			return $item->order_id;
		}

		return '';
	}
}

BWFAN_API_Loader::register( 'BWFAN_API_Get_Lost_Carts' );
