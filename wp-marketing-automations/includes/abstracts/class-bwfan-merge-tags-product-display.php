<?php

#[AllowDynamicProperties]
abstract class Merge_Tag_Abstract_Product_Display extends BWFAN_Merge_Tag {
	public $support_limit_field = false;
	public $supports_order_table = false;
	public $supports_cart_table = false;
	public $template = null;
	public $fallback = null;
	public $products = [];
	public $cart = null;
	public $data = null;
	public $order = null;
	public $products_quantity = null;
	public $products_sku = [];
	public $products_price = null;

	/**
	 * Show the html in popup for the merge tag.
	 */
	public function get_view() {
		$templates = $this->get_view_data();
		$this->get_back_button();
		?>
        <div class="bwfan_mtag_wrap">
            <div class="bwfan_label">
                <label for="" class="bwfan-label-title"><?php esc_html_e( 'Select Template', 'wp-marketing-automations' ); ?></label>
            </div>
            <div class="bwfan_label_val">
                <select id="" class="bwfan-input-wrapper bwfan_tag_select" name="template">
					<?php
					foreach ( $templates as $slug => $name ) {
						echo '<option value="' . esc_attr( $slug ) . '">' . esc_attr( $name ) . '</option>';
					}
					?>
                </select>
            </div>
        </div>
		<?php
		if ( $this->support_fallback ) {
			$this->get_fallback();
		}

		$this->get_preview();
		$this->get_copy_button();
	}

	public function get_view_data() {
		$templates = array(
			''                                   => __( 'Product Grid - 2 Column', 'wp-marketing-automations' ),
			'product-grid-3-col'                 => __( 'Product Grid - 3 Column', 'wp-marketing-automations' ),
			'product-rows'                       => __( 'Product Rows', 'wp-marketing-automations' ),
			'review-rows'                        => __( 'Product Rows (With Review Button)', 'wp-marketing-automations' ),
			'order-table'                        => __( 'WooCommerce Order Summary Layout', 'wp-marketing-automations' ),
			'cart-table'                         => __( 'Cart Table Layout', 'wp-marketing-automations' ),
			'list-comma-separated'               => __( 'List - Comma Separated (Product Names only)', 'wp-marketing-automations' ),
			'list-comma-separated-with-quantity' => __( 'List - Comma Separated (Product Names with Quantity)', 'wp-marketing-automations' ),
		);

		if ( ! $this->supports_cart_table ) {
			unset( $templates['cart-table'] );
		}
		if ( ! $this->supports_order_table ) {
			unset( $templates['order-table'] );
			unset( $templates['review-rows'] );
		}

		return $templates;
	}

	public function process_shortcode( $attr ) {
		$cart              = false;
		$data              = null;
		$products          = [];
		$products_quantity = [];
		$products_price    = [];
		if ( ! is_null( $this->cart ) && is_array( $this->cart ) && count( $this->cart ) > 0 ) {
			$cart = $this->cart;
		}
		if ( ! is_null( $this->data ) && is_array( $this->data ) && count( $this->data ) > 0 ) {
			$data = $this->data;
		}
		if ( is_array( $this->products ) && count( $this->products ) > 0 ) {
			$products = $this->products;
		}

		if ( is_array( $this->products_quantity ) && count( $this->products_quantity ) > 0 ) {
			$products_quantity = $this->products_quantity;
		}

		if ( is_array( $this->products_sku ) && count( $this->products_sku ) > 0 ) {
			$products_sku = $this->products_sku;
		}

		if ( is_array( $this->products_price ) && count( $this->products_price ) > 0 ) {
			$products_price = $this->products_price;
		}

		$this->template = 'product-grid-2-col';
		if ( isset( $attr['template'] ) ) {
			$this->template = $attr['template'];
		}

		/** Allowed templates for product display settings */
		$allowed_templates = array( 'product-grid-2-col', 'product-grid-3-col' );

		/** if display product count is set in mergetag then remove remaining products */
		if ( in_array( $this->template, $allowed_templates, false ) && isset( $attr['display'] ) && absint( $attr['display'] ) >= 1 && absint( $attr['display'] ) < count( $products ) ) {
			$products = array_splice( $products, 0, absint( $attr['display'] ) );
		}

		/** Filter products in case want to hide free products */
		$hide_free_products = BWFAN_Common::hide_free_products_cart_order_items();
		if ( true === $hide_free_products ) {
			/** $products */
			$products_mod = array_filter( $products, function ( $single_product ) {
				return ( $single_product->get_price() > 0 );
			} );
			$products     = $products_mod;
		}

		if ( true === BWFAN_Merge_Tag_Loader::get_data( 'is_preview' ) && empty( $products ) ) {
			$products = wc_get_products( array(
				'numberposts' => 3,
				'post_status' => 'published', // Only published products
			) );
		}
		if ( apply_filters( 'bwfan_current_integration_action', false ) ) {
			$product_names = [];
			foreach ( $products as $single_product ) {
				$product_names[] = BWFAN_Common::get_name( $single_product );
			}
			$product_names = wp_json_encode( $product_names );

			return $product_names;
		}

		if ( isset( $attr['fallback'] ) ) {
			$this->fallback = $attr['fallback'];
		}

		if ( 'list' === $this->template ) {
			$type = 'comma-separated';
			if ( isset( $attr['type'] ) && ! empty( $attr['type'] ) ) {
				$type = $attr['type'];
			}
			$this->template = $this->template . '-' . $type;
		}

		/** Handle line-separated output */
		if ( 'line' === $this->template ) {
			$type_line = isset( $attr['type_line'] ) && ! empty( $attr['type_line'] ) ? $attr['type_line'] : 'separated-product-name';
			$items     = $cart ? $cart : $products;
			$is_cart   = $cart ? true : false;

			return self::get_formatted_items_in_line( $items, $type_line, $products_quantity, $is_cart, $attr );
		}

		if ( isset( $data['currency'] ) && ! empty( $data['currency'] ) ) {
			remove_all_filters( 'woocommerce_currency_symbol' );
		}

		$file_path = BWFAN_PLUGIN_DIR . '/templates/' . $this->template . '.php';
		$file_path = apply_filters( 'bwfan_cart_items_template_path', $file_path, $cart, $data, $attr );
		if ( ! file_exists( $file_path ) ) {
			return '';
		}

		ob_start();
		include $file_path;
		$response = ob_get_clean();

		return apply_filters( 'bwfan_alter_email_body', $response, $products, $this->template, $products_quantity );
	}

	/**
	 * Format items into lines with quantity and names.
	 *
	 * @param $items
	 * @param $type_line
	 * @param $products_quantity
	 * @param $is_cart
	 * @param $attr
	 *
	 * @return array|string
	 */
	public static function get_formatted_items_in_line( $items, $type_line, $products_quantity, $is_cart, $attr ) {
		if ( $is_cart && isset( $items['cart_items'] ) ) {
			$items = $items['cart_items'];
		}
		if ( empty( $items ) || ! is_array( $items ) ) {
			return [];
		}
		$result = [];

		foreach ( $items as $item ) {
			$product = $is_cart ? ( $item['data'] ?? null ) : $item;
			if ( empty( $product ) || ! $product instanceof WC_Product ) {
				continue;
			}

			$product_quantity  = $products_quantity[ $product->get_id() ] ?? 1;
			$bwfan_separator   = apply_filters( 'bwfan_line_separator_symbol', '-', $product, $attr );
			$formatted_product = apply_filters( 'bwfan_line_separator_formate', $product->get_name() . " X " . $product_quantity, 'X', $product->get_name(), $product_quantity, $attr );
			$result[]          = $type_line !== 'separated-product-name' ? "$bwfan_separator $formatted_product" : "$bwfan_separator " . $product->get_name();
		}

		$bwfan_line_separator = apply_filters( 'bwfan_line_separator', "\n\r", $product, $attr );

		return implode( $bwfan_line_separator, $result );
	}

	public function prepare_products( $product_ids, $orderby = 'date', $order = 'DESC', $limit = 8 ) {
		if ( empty( $product_ids ) ) {
			return [];
		}

		$product_ids = array_filter( $product_ids );
		$args        = [
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
			'posts_per_page'      => $limit,
			'post__in'            => $product_ids,
			'fields'              => 'ids',
			'orderby'             => $orderby,
			'order'               => $order,
			'tax_query'           => $this->get_taxonomy_query(),
			'meta_query'          => WC()->query->get_meta_query(),
		];

		if ( 'popularity' === $orderby ) {
			$args['meta_key'] = 'total_sales';
			$args['orderby']  = 'meta_value_num';
		}
		$query = new WP_Query( $args );

		return array_map( 'wc_get_product', $query->posts );
	}

	protected function get_taxonomy_query( $taxonomy_query = [] ) {
		$product_visibility_not_in = [];
		$product_visibility_terms  = wc_get_product_visibility_term_ids();

		// Hide out of stock products.
		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
			$product_visibility_not_in[] = $product_visibility_terms['outofstock'];
		}
		if ( ! empty( $product_visibility_not_in ) ) {
			$taxonomy_query[] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_not_in,
				'operator' => 'NOT IN',
			];
		}

		return $taxonomy_query;
	}

}
