<?php

class BWFAN_Rule_Cart_Total extends BWFAN_Rule_Base {

	public $supports = array( 'cart' );

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_total' );
	}

	/** v2 Methods: START */

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		$abandoned_data = $automation_data['global']['cart_details'];
		$price          = (float) $abandoned_data['total'];
		$value          = (float) $rule_data['data'];

		switch ( $rule_data['rule'] ) {
			case '==':
				$result = $price === $value;
				break;
			case '!=':
				$result = $price !== $value;
				break;
			case '>':
				$result = $price > $value;
				break;
			case '<':
				$result = $price < $value;
				break;
			case '>=':
				$result = $price >= $value;
				break;
			case '<=':
				$result = $price <= $value;
				break;
			default:
				$result = false;
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	public function get_condition_input_type() {
		return 'Text';
	}

	public function is_match( $rule_data ) {
		$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$price          = (float) $abandoned_data['total'];
		$value          = (float) $rule_data['condition'];

		switch ( $rule_data['operator'] ) {
			case '==':
				$result = $price === $value;
				break;
			case '!=':
				$result = $price !== $value;
				break;
			case '>':
				$result = $price > $value;
				break;
			case '<':
				$result = $price < $value;
				break;
			case '>=':
				$result = $price >= $value;
				break;
			case '<=':
				$result = $price <= $value;
				break;
			default:
				$result = false;
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	public function ui_view() {
		?>
        Cart Total
        <% var ops = JSON.parse('<?php echo wp_json_encode( $this->get_possible_rule_operators() ); ?>'); %>

        <%= ops[operator] %>
        <%= condition %>
		<?php
	}

	public function get_possible_rule_operators() {
		return $this->get_possible_number_rule_operators();
	}

}

class BWFAN_Rule_All_Cart_Items_Purchased extends BWFAN_Rule_Base {

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'all_cart_items_purchased' );
	}

	/** v2 Methods: START */

	public function get_options( $term = '' ) {
		return $this->get_possible_rule_values();
	}

	public function get_possible_rule_values() {
		return array(
			'yes' => __( 'Yes', 'wp-marketing-automations' ),
			'no'  => __( 'No', 'wp-marketing-automations' ),
		);
	}

	public function get_rule_type() {
		return 'Select';
	}

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		$abandoned_data = $automation_data['global']['cart_details'];
		$cart_contents  = maybe_unserialize( $abandoned_data['items'] );

		$user_id = 0;
		$user    = get_user_by( 'email', $abandoned_data['email'] );
		if ( $user instanceof WP_User ) {
			$user_id = $user->ID;
		}

		$customer = bwf_get_contact( $user_id, $abandoned_data['email'] );
		if ( $customer->get_id() <= 0 ) {
			return 'no' === $rule_data['data'];
		}

		$customer->set_customer_child();
		$products = $customer->get_customer_purchased_products();
		if ( empty( $products ) ) {
			return 'no' === $rule_data['data'];
		}

		$result = false;
		if ( is_array( $cart_contents ) && count( $cart_contents ) ) {
			$cart_products = [];
			foreach ( $cart_contents as $cart_item ) {
				$id = $cart_item['variation_id'];
				if ( 0 === absint( $id ) ) {
					$id = $cart_item['product_id'];
				}
				$cart_products[] = $id;
			}

			if ( empty( array_diff( $cart_products, $products ) ) ) {
				$result = true;
			}
		}

		return ( 'yes' === $rule_data['data'] ) ? $result : ! $result;
	}

	/** v2 Methods: END */

	public function get_possible_rule_operators() {
		return null;
	}

	public function is_match( $rule_data ) {
		$result         = false;
		$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$cart_contents  = maybe_unserialize( $abandoned_data['items'] );

		$user_id = 0;
		$user    = get_user_by( 'email', $abandoned_data['email'] );
		if ( $user instanceof WP_User ) {
			$user_id = $user->ID;
		}

		$customer = bwf_get_contact( $user_id, $abandoned_data['email'] );
		if ( $customer->get_id() <= 0 ) {
			return 'no' === $rule_data['condition'];
		}

		$customer->set_customer_child();
		$products = $customer->get_customer_purchased_products();
		if ( empty( $products ) ) {
			return 'no' === $rule_data['condition'];
		}

		if ( is_array( $cart_contents ) && count( $cart_contents ) ) {
			$cart_products = [];
			foreach ( $cart_contents as $cart_item ) {
				$id = $cart_item['variation_id'];
				if ( 0 === absint( $id ) ) {
					$id = $cart_item['product_id'];
				}
				$cart_products[] = $id;
			}

			if ( empty( array_diff( $cart_products, $products ) ) ) {
				$result = true;
			}
		}

		return ( 'yes' === $rule_data['condition'] ) ? $result : ! $result;
	}

	public function ui_view() {
		?>
        <% if (condition == "yes") { %>All <% } %>
        <% if (condition == "no") { %>No <% } %>
		<?php
		esc_html_e( ' Cart Items purchased in the past', 'wp-marketing-automations' );
	}

}

class BWFAN_Rule_Cart_Product extends BWFAN_Rule_Products {

	public $supports = array( 'cart' );

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_product' );
	}

	public function get_condition_input_type() {
		return 'Cart_Product_Select';
	}

	/** v2 Methods: START */

	public function get_options( $term = '' ) {
		return $this->get_search_results( $term, true );
	}

	public function get_rule_type() {
		return 'product-qty';
	}

	public function get_value_label() {
		return __( 'Product', 'wp-marketing-automations' );
	}

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		$abandoned_data = $automation_data['global']['cart_details'];
		$cart_contents  = maybe_unserialize( $abandoned_data['items'] );
		$products       = isset( $rule_data['data']['search'] ) ? $rule_data['data']['search'] : [];

		$products = array_map( function ( $product ) {
			return absint( $product['key'] );
		}, $products );

		/** Marking $products always array */
		$quantity       = isset( $rule_data['data']['qty'] ) ? absint( $rule_data['data']['qty'] ) : 1;
		$type           = $rule_data['rule'];
		$found_quantity = 0;

		if ( $cart_contents && is_array( $cart_contents ) && count( $cart_contents ) ) {
			foreach ( $cart_contents as $cart_item ) {
				if ( in_array( intval( $cart_item['product_id'] ), $products, true ) || ( isset( $cart_item['variation_id'] ) && in_array( intval( $cart_item['variation_id'] ), $products, true ) ) ) {
					$found_quantity += $cart_item['quantity'];
				}
			}
		}

		$found_quantity = absint( $found_quantity );
		$result         = false;

		switch ( $type ) {
			case '<':
				$result = $quantity >= $found_quantity;
				break;
			case '>':
				$result = $quantity <= $found_quantity;
				break;
			case '==':
				$result = $quantity === $found_quantity;
				break;
			case '!=':
				$result = $quantity !== $found_quantity;
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	/** v2 Methods: END */

	public function get_condition_values_nice_names( $values ) {
		$return = array();
		if ( empty( $values ) || ! isset( $values['products'] ) ) {
			return $return;
		}

		if ( is_array( $values['products'] ) ) {
			foreach ( $values['products'] as $id ) {
				$return[ $id ] = BWFAN_Common::get_formatted_product_name( wc_get_product( $id ) );
			}
		} elseif ( absint( $values['products'] ) > 0 ) {
			$return[ $values['products'] ] = BWFAN_Common::get_formatted_product_name( wc_get_product( $values['products'] ) );
		}

		return $return;
	}

	public function get_search_type_name() {
		return 'product_search';
	}

	public function is_match( $rule_data ) {
		$result         = false;
		$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$cart_contents  = maybe_unserialize( $abandoned_data['items'] );
		$products       = isset( $rule_data['condition']['products'] ) ? $rule_data['condition']['products'] : [];

		/** Marking $products always array */
		$products       = is_array( $products ) ? array_map( 'intval', $products ) : [ absint( $products ) ];
		$quantity       = absint( $rule_data['condition']['qty'] );
		$type           = $rule_data['operator'];
		$found_quantity = 0;

		if ( $cart_contents && is_array( $cart_contents ) && count( $cart_contents ) ) {
			foreach ( $cart_contents as $cart_item ) {
				if ( in_array( intval( $cart_item['product_id'] ), $products, true ) || ( isset( $cart_item['variation_id'] ) && in_array( intval( $cart_item['variation_id'] ), $products, true ) ) ) {
					$found_quantity += $cart_item['quantity'];
				}
			}
		}

		$found_quantity = absint( $found_quantity );

		switch ( $type ) {
			case '<':
				$result = $quantity >= $found_quantity;
				break;
			case '>':
				$result = $quantity <= $found_quantity;
				break;
			case '==':
				$result = $quantity === $found_quantity;
				break;
			case '!=':
				$result = $quantity !== $found_quantity;
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	public function ui_view() {
		?>
        Cart Items
        <% var ops = JSON.parse('<?php echo wp_json_encode( $this->get_possible_rule_operators() ); ?>'); %>
        <%= ops[operator] +' ' +condition.qty +' qty of' %>
        <% var chosen = []; %>
        <% if(_.has(condition, 'products')) { %>
        <% chosen.push(uiData[condition.products]); %>
        <% } %>
        <%= chosen.join("/ ") %>
		<?php
	}

	public function get_possible_rule_operators() {
		return array(
			'>'  => __( 'contains at least', 'wp-marketing-automations' ),
			'<'  => __( 'contains less than', 'wp-marketing-automations' ),
			'==' => __( 'contains exactly', 'wp-marketing-automations' ),
			'!=' => __( 'does not contain', 'wp-marketing-automations' ),
		);
	}
}

class BWFAN_Rule_Cart_Category extends BWFAN_Rule_Term_Taxonomy {

	public $supports = array( 'cart' );
	public $taxonomy_name = 'product_cat';

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_category' );
		$this->v2 = true;
	}

	/** v2 Methods: START */

	public function get_options( $term = '' ) {
		return $this->get_search_results( $term, true );
	}

	public function get_rule_type() {
		return 'Search';
	}

	/** v2 Methods: END */

	public function get_possible_rule_values() {
		$result = array();
		$terms  = get_terms( 'product_cat', array(
			'hide_empty' => false,
		) );

		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		}

		return $result;
	}

	public function get_term_ids( $automation_data = [] ) {
		if ( ! empty( $automation_data ) && isset( $automation_data['global'] ) && is_array( $automation_data['global'] ) ) {
			$abandoned_data = $automation_data['global']['cart_details'];
		} else {
			$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		}
		$cart_contents = maybe_unserialize( $abandoned_data['items'] );
		$all_terms     = array();
		if ( ! is_array( $cart_contents ) || 0 === count( $cart_contents ) ) {
			return $all_terms;
		}

		foreach ( $cart_contents as $item ) {
			$product_id = $item['product_id'];
			$product    = wc_get_product( $product_id );
			$product_id = ( $product->get_parent_id() ) ? $product->get_parent_id() : $product_id;
			$terms      = wp_get_object_terms( $product_id, $this->taxonomy_name, array(
				'fields' => 'ids',
			) );

			$all_terms = array_merge( $all_terms, $terms );
		}

		return $all_terms;
	}

	public function ui_view() {
		esc_html_e( 'Cart Category ', 'wp-marketing-automations' );
		?>
        <% var ops = JSON.parse('<?php echo wp_json_encode( $this->get_possible_rule_operators() ); ?>'); %>

        <%= ops[operator] %><% var chosen = []; %>
        <% _.each(condition, function( value, key ){ %>
        <% chosen.push(uiData[value]); %>

        <% }); %>
        <%= chosen.join("/ ") %>
		<?php
	}

	public function get_possible_rule_operators() {
		return array(
			'any'  => __( 'matches any of', 'wp-marketing-automations' ),
			'none' => __( 'matches none of', 'wp-marketing-automations' ),
		);
	}
}

class BWFAN_Rule_Cart_Items_Tag extends BWFAN_Rule_Term_Taxonomy {

	public $supports = array( 'cart' );
	public $taxonomy_name = 'product_tag';

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_items_tag' );
	}

	/** v2 Methods: START */

	public function get_options( $term = '' ) {
		return $this->get_search_results( $term, true );
	}

	public function get_rule_type() {
		return 'Search';
	}

	/** v2 Methods: END */

	public function get_possible_rule_values() {
		$result = array();
		$terms  = get_terms( 'product_tag', array(
			'hide_empty' => false,
		) );

		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		}

		return $result;
	}

	public function get_term_ids( $automation_data = [] ) {
		if ( ! empty( $automation_data ) && isset( $automation_data['global'] ) && is_array( $automation_data['global'] ) ) {
			$abandoned_data = $automation_data['global']['cart_details'];
		} else {
			$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		}
		$cart_contents = maybe_unserialize( $abandoned_data['items'] );
		$all_terms     = array();
		if ( ! is_array( $cart_contents ) || 0 === count( $cart_contents ) ) {
			return $all_terms;
		}

		foreach ( $cart_contents as $item ) {
			$product_id = $item['product_id'];
			$product    = wc_get_product( $product_id );
			$product_id = ( $product->get_parent_id() ) ? $product->get_parent_id() : $product_id;
			$terms      = wp_get_object_terms( $product_id, $this->taxonomy_name, array(
				'fields' => 'ids',
			) );

			$all_terms = array_merge( $all_terms, $terms );
		}

		return $all_terms;
	}

	public function ui_view() {
		esc_html_e( 'Cart Items Tag ', 'wp-marketing-automations' );
		?>
        <% var ops = JSON.parse('<?php echo wp_json_encode( $this->get_possible_rule_operators() ); ?>'); %>

        <%= ops[operator] %><% var chosen = []; %>
        <% _.each(condition, function( value, key ){ %>
        <% chosen.push(uiData[value]); %>

        <% }); %>
        <%= chosen.join("/ ") %>
		<?php
	}

	public function get_possible_rule_operators() {
		return array(
			'any'  => __( 'matches any of', 'wp-marketing-automations' ),
			'none' => __( 'matches none of', 'wp-marketing-automations' ),
		);
	}
}

class BWFAN_Rule_Cart_Coupons extends BWFAN_Dynamic_Option_Base {

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_coupons' );
	}

	public function get_condition_values_nice_names( $values ) {
		$return = [];
		if ( count( $values ) > 0 ) {
			foreach ( $values as $coupon_id ) {
				$return[ $coupon_id ] = get_the_title( $coupon_id );
			}
		}

		return $return;
	}

	/** v2 Methods: START */

	public function get_options( $term = '' ) {
		return $this->get_search_results( $term, true );
	}

	public function get_search_results( $term, $v2 = false ) {
		$array = array();
		$args  = array(
			'post_type'      => 'shop_coupon',
			'posts_per_page' => 10,
			'paged'          => 1,
			's'              => $term ?? '',
		);

		$posts = get_posts( $args );
		if ( $posts && is_array( $posts ) && count( $posts ) > 0 ) {
			foreach ( $posts as $post ) :
				setup_postdata( $post );
				if ( ! $v2 ) {
					$array[] = array(
						'id'   => (string) $post->ID,
						'text' => $post->post_title,
					);
				} else {
					$array[ $post->ID ] = $post->post_title;
				}
			endforeach;
		}

		if ( $v2 ) {
			return $array;
		}

		wp_send_json( array(
			'results' => $array,
		) );
	}

	public function get_rule_type() {
		return 'Search';
	}

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		global $wpdb;
		$type           = $rule_data['rule'];
		$abandoned_data = $automation_data['global']['cart_details'];
		$used_coupons   = maybe_unserialize( $abandoned_data['coupons'] );

		$saved_coupons = array_map( function ( $data ) {
			return $data['key'];
		}, $rule_data['data'] );

		if ( empty( $used_coupons ) ) {
			if ( 'all' === $type || 'any' === $type ) {
				$res = false;
			} else {
				$res = true;
			}

			return $this->return_is_match( $res, $rule_data );
		}

		$used_coupons_ids = [];
		foreach ( $used_coupons as $coupon => $value ) { //phpcs:ignore WordPressVIPMinimum.Variables.VariableAnalysis
			$used_coupons_ids[] = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_title = %s AND post_type = 'shop_coupon' AND post_status = 'publish' LIMIT 1;", $coupon ) ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		}

		$result = false;
		switch ( $type ) {
			case 'all':
				if ( is_array( $saved_coupons ) && is_array( $used_coupons_ids ) ) {
					$result = count( array_intersect( $saved_coupons, $used_coupons_ids ) ) === count( $saved_coupons );
				}
				break;
			case 'any':
				if ( is_array( $saved_coupons ) && is_array( $used_coupons_ids ) ) {
					$result = count( array_intersect( $saved_coupons, $used_coupons_ids ) ) >= 1;
				}
				break;

			case 'none':
				if ( is_array( $saved_coupons ) && is_array( $used_coupons_ids ) ) {
					$result = count( array_intersect( $saved_coupons, $used_coupons_ids ) ) === 0;
				}
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	/** v2 Methods: END */

	public function get_search_type_name() {
		return 'coupon_rule';
	}

	public function is_match( $rule_data ) {
		global $wpdb;
		$type           = $rule_data['operator'];
		$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$used_coupons   = maybe_unserialize( $abandoned_data['coupons'] );

		if ( empty( $used_coupons ) ) {
			if ( 'all' === $type || 'any' === $type ) {
				$res = false;
			} else {
				$res = true;
			}

			return $this->return_is_match( $res, $rule_data );
		}

		$used_coupons_ids = [];
		foreach ( $used_coupons as $coupon => $value ) { //phpcs:ignore WordPressVIPMinimum.Variables.VariableAnalysis
			$used_coupons_ids[] = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_title = %s AND post_type = 'shop_coupon' AND post_status = 'publish' LIMIT 1;", $coupon ) ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		}

		$result = false;
		switch ( $type ) {
			case 'all':
				if ( is_array( $rule_data['condition'] ) && is_array( $used_coupons_ids ) ) {
					$result = count( array_intersect( $rule_data['condition'], $used_coupons_ids ) ) === count( $rule_data['condition'] );
				}
				break;
			case 'any':
				if ( is_array( $rule_data['condition'] ) && is_array( $used_coupons_ids ) ) {
					$result = count( array_intersect( $rule_data['condition'], $used_coupons_ids ) ) >= 1;
				}
				break;

			case 'none':
				if ( is_array( $rule_data['condition'] ) && is_array( $used_coupons_ids ) ) {
					$result = count( array_intersect( $rule_data['condition'], $used_coupons_ids ) ) === 0;
				}
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	public function ui_view() {
		echo esc_html__( 'Cart Coupon Code', 'wp-marketing-automations' );
		?>
        <% var ops = JSON.parse('<?php echo wp_json_encode( $this->get_possible_rule_operators() ); ?>'); %>

        <%= ops[operator] %> <% var chosen = []; %>
        <% _.each(condition, function( value, key ){ %>
        <% chosen.push(uiData[value]); %>

        <% }); %>
        <%= chosen.join("/ ") %>
		<?php
	}

	public function get_possible_rule_operators() {
		return array(
			'any'  => __( 'matches any of', 'wp-marketing-automations' ),
			'all'  => __( 'matches all of ', 'wp-marketing-automations' ),
			'none' => __( 'matches none of', 'wp-marketing-automations' ),
		);
	}
}

class BWFAN_Rule_Cart_Coupon_Text_Match extends BWFAN_Rule_Base {

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_coupon_text_match' );
	}

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		$abandoned_data = $automation_data['global']['cart_details'];
		$used_coupons   = maybe_unserialize( $abandoned_data['coupons'] );

		return $this->return_is_match( BWFAN_Common::validate_string_multi( $used_coupons, $rule_data['rule'], $rule_data['data'] ), $rule_data );
	}

	public function conditions_view() {
		$condition_input_type = $this->get_condition_input_type();
		$values               = $this->get_possible_rule_values();
		$value_args           = array(
			'input'       => $condition_input_type,
			'name'        => 'bwfan_rule[<%= groupId %>][<%= ruleId %>][condition]',
			'choices'     => $values,
			'placeholder' => __( 'Enter Few Characters...', 'wp-marketing-automations' ),
		);

		bwfan_Input_Builder::create_input_field( $value_args );
	}

	public function get_condition_input_type() {
		return 'Text';
	}

	public function get_possible_rule_values() {
		return null;
	}

	public function is_match( $rule_data ) {
		$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$used_coupons   = maybe_unserialize( $abandoned_data['coupons'] );

		return $this->return_is_match( BWFAN_Common::validate_string_multi( $used_coupons, $rule_data['operator'], $rule_data['condition'] ), $rule_data );
	}

	public function ui_view() {
		?>
        Cart Coupon Code
        <% var ops = JSON.parse('<?php echo wp_json_encode( $this->get_possible_rule_operators() ); ?>'); %>

        <%= ops[operator] %>
        '<%= condition %>'
		<?php
	}

	public function get_possible_rule_operators() {
		return array(
			'contains'    => __( 'contains', 'wp-marketing-automations' ),
			'is'          => __( 'matches exactly', 'wp-marketing-automations' ),
			'starts_with' => __( 'starts with', 'wp-marketing-automations' ),
			'ends_with'   => __( 'ends with', 'wp-marketing-automations' ),
		);
	}
}

class BWFAN_Rule_Cart_Contains_Coupon extends BWFAN_Rule_Base {

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_contains_coupon' );
	}

	/** v2 Methods: START */

	public function get_options( $term = '' ) {
		return $this->get_possible_rule_values();
	}

	public function get_possible_rule_values() {
		return array(
			'yes' => __( 'Yes', 'wp-marketing-automations' ),
			'no'  => __( 'No', 'wp-marketing-automations' ),
		);
	}

	public function get_rule_type() {
		return 'Select';
	}

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		$abandoned_data = $automation_data['global']['cart_details'];
		$cart_coupon    = maybe_unserialize( $abandoned_data['coupons'] );

		$result = false;
		if ( ! empty( $cart_coupon ) ) {
			$result = true;
		}

		return ( 'yes' === $rule_data['data'] ) ? $result : ! $result;
	}

	public function get_default_rule_value() {
		return 'yes';
	}

	/** v2 Methods: END */

	public function get_possible_rule_operators() {
		return null;
	}

	public function is_match( $rule_data ) {
		$result         = false;
		$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$cart_coupon    = maybe_unserialize( $abandoned_data['coupons'] );

		if ( ! empty( $cart_coupon ) ) {
			$result = true;
		}

		return ( 'yes' === $rule_data['condition'] ) ? $result : ! $result;
	}

	public function ui_view() {
		esc_html_e( 'Cart', 'wp-marketing-automations' );
		?>
        <% if (condition == "yes") { %> contains <% } %>
        <% if (condition == "no") { %> does not contain <% } %>
		<?php
		esc_html_e( 'Coupon', 'wp-marketing-automations' );
	}

}

class BWFAN_Rule_Cart_Item_Count extends BWFAN_Rule_Base {

	public $supports = array( 'cart' );

	public function __construct() {
		$this->v2 = true;
		parent::__construct( 'cart_item_count' );
	}

	/** v2 Methods: START */

	public function get_rule_type() {
		return 'Number';
	}

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		$abandoned_data = $automation_data['global']['cart_details'];
		$cart_contents  = maybe_unserialize( $abandoned_data['items'] );

		/** Marking $products always array */
		$value          = absint( $rule_data['data'] );
		$found_quantity = ( is_array( $cart_contents ) && count( $cart_contents ) > 0 ) ? count( $cart_contents ) : 0;

		switch ( $rule_data['rule'] ) {
			case '==':
				$result = absint( $found_quantity ) === $value;
				break;
			case '!=':
				$result = absint( $found_quantity ) !== $value;
				break;
			case '>':
				$result = absint( $found_quantity ) > $value;
				break;
			case '<':
				$result = absint( $found_quantity ) < $value;
				break;
			case '>=':
				$result = absint( $found_quantity ) >= $value;
				break;
			case '<=':
				$result = absint( $found_quantity ) <= $value;
				break;
			default:
				$result = false;
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	/** v2 Methods: END */

	public function get_condition_input_type() {
		return 'Text';
	}

	public function is_match( $rule_data ) {
		$abandoned_data = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$cart_contents  = maybe_unserialize( $abandoned_data['items'] );

		/** Marking $products always array */
		$value          = absint( $rule_data['condition'] );
		$found_quantity = ( is_array( $cart_contents ) && count( $cart_contents ) > 0 ) ? count( $cart_contents ) : 0;

		switch ( $rule_data['operator'] ) {
			case '==':
				$result = absint( $found_quantity ) === $value;
				break;
			case '!=':
				$result = absint( $found_quantity ) !== $value;
				break;
			case '>':
				$result = absint( $found_quantity ) > $value;
				break;
			case '<':
				$result = absint( $found_quantity ) < $value;
				break;
			case '>=':
				$result = absint( $found_quantity ) >= $value;
				break;
			case '<=':
				$result = absint( $found_quantity ) <= $value;
				break;
			default:
				$result = false;
				break;
		}

		return $this->return_is_match( $result, $rule_data );
	}

	public function ui_view() {
		?>
        Cart Item Count is
        <% var ops = JSON.parse('<?php echo wp_json_encode( $this->get_possible_rule_operators() ); ?>'); %>

        <%= ops[operator] %>
        <%= condition %>
		<?php
	}

	public function get_possible_rule_operators() {
		return $this->get_possible_number_rule_operators();
	}

}

class BWFAN_Rule_Is_Global_Checkout extends BWFAN_Rule_Base {

	public function __construct() {
		parent::__construct( 'is_global_checkout' );
	}

	/** v2 Methods: START */

	public function get_options( $term = '' ) {
		return $this->get_possible_rule_values();
	}

	public function get_possible_rule_values() {
		return array(
			'yes' => __( 'Yes', 'wp-marketing-automations' ),
			'no'  => __( 'No', 'wp-marketing-automations' ),
		);
	}

	public function get_rule_type() {
		return 'Select';
	}

	public function is_match_v2( $automation_data, $rule_data ) {
		if ( ! isset( $automation_data['global'] ) || ! is_array( $automation_data['global'] ) ) {
			return $this->return_is_match( false, $rule_data );
		}

		$abandoned_data        = $automation_data['global']['cart_details'];
		$abandoned_checkout_id = isset( $abandoned_data['checkout_page_id'] ) ? $abandoned_data['checkout_page_id'] : 0;
		$global_checkout_id    = wc_get_page_id( 'checkout' );
		$checkout_data         = isset( $abandoned_data['checkout_page_id'] ) ? json_decode( $abandoned_data['checkout_data'], true ) : [];
		$is_checkout_override  = isset( $checkout_data['aero_data'] ) && isset( $checkout_data['aero_data']['wfacp_is_checkout_override'] ) ? $checkout_data['aero_data']['wfacp_is_checkout_override'] : false;

		/** check for aerocheckout */
		if ( class_exists( ( 'WFACP_Common' ) ) && $is_checkout_override ) {
			$global_checkout_id = WFACP_Common::get_checkout_page_id();
		}

		$result = ( absint( $global_checkout_id ) === absint( $abandoned_checkout_id ) ) ? true : false;

		return ( 'yes' === $rule_data['data'] ) ? $result : ! $result;
	}

	/** v2 Methods: END */

	public function get_possible_rule_operators() {
		return null;
	}

	public function is_match( $rule_data ) {
		$result                = false;
		$abandoned_data        = BWFAN_Core()->rules->getRulesData( 'abandoned_data' );
		$abandoned_checkout_id = isset( $abandoned_data['checkout_page_id'] ) ? $abandoned_data['checkout_page_id'] : 0;
		$global_checkout_id    = wc_get_page_id( 'checkout' );
		$checkout_data         = isset( $abandoned_data['checkout_page_id'] ) ? json_decode( $abandoned_data['checkout_data'], true ) : [];
		$is_checkout_override  = isset( $checkout_data['aero_data'] ) && isset( $checkout_data['aero_data']['wfacp_is_checkout_override'] ) ? $checkout_data['aero_data']['wfacp_is_checkout_override'] : false;

		/** check for aerocheckout */
		if ( class_exists( ( 'WFACP_Common' ) ) && $is_checkout_override ) {
			$global_checkout_id = WFACP_Common::get_checkout_page_id();
		}

		if ( absint( $global_checkout_id ) === absint( $abandoned_checkout_id ) ) {
			$result = true;
		}

		return ( 'yes' === $rule_data['condition'] ) ? $result : ! $result;
	}

	public function ui_view() {
		?>
        <% if (condition == "yes") { %> Is <% } %>
        <% if (condition == "no") { %> Is not <% } %>
		<?php
		esc_html_e( 'Global Checkout', 'wp-marketing-automations' );
	}

}
