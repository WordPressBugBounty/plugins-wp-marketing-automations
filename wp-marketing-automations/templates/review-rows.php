<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$reviewable_products = [];
if ( is_array( $products ) ) {
	/** Filter products to include only those with reviews allowed */
	$reviewable_products = array_filter( $products, function ( $product ) {
		if ( ! $product instanceof WC_Product ) {
			return false;
		}
		$parent_product_id = $product->get_parent_id();
		if ( ! empty( $parent_product_id ) ) {
			$product = wc_get_product( $parent_product_id );
		}

		return $product->get_reviews_allowed();
	} );
}
if ( empty( $reviewable_products ) ) {
	return;
}

add_action( 'bwfan_output_email_style', function () {
	$button_background_color = apply_filters( 'bwfan_wc_email_get_base_color', get_option( 'woocommerce_email_base_color' ) );
	$button_text_color       = BWFAN_Common::color_light_or_dark( $button_background_color, '#202020', '#ffffff' );
	$button_text_color       = apply_filters( 'bwfan_wc_email_get_text_color', $button_text_color );
	?>
    .bwfan-email-review-rows .bwfan-product-rows {
    width: 100%;
    border: 2px solid #e5e5e5;
    border-collapse: collapse;
    max-width:700px;
    }
    #body_content .bwfan-email-review-rows .bwfan-product-rows td {
    padding: 10px 12px;
    }
    .bwfan-email-review-rows .autonami-button {
    background-color: <?php echo esc_attr( $button_background_color ); ?>;
    color: <?php echo esc_attr( $button_text_color ); ?>;
    }
	<?php
} );

$review_hash_path = apply_filters( 'bwfan_review_section_hash_path', '#tab-reviews' );
$order            = $this->order instanceof WC_Order ? $this->order : null;
?>
<div class='bwfan-email-review-rows bwfan-email-table-wrap'>
    <!--[if mso]>
    <table>
        <tr>
            <td width="700">
    <![endif]-->
    <table cellspacing="0" cellpadding="0" style="width: 100%;" class="bwfan-product-rows">
        <tbody>
		<?php foreach ( $reviewable_products as $product ) :
			if ( ! $product instanceof WC_Product ) {
				continue;
			}
			$parent_product_id = $product->get_parent_id();
			$review_link       = $product->get_permalink();
			if ( ! empty( $parent_product_id ) ) {
				$parent_product = wc_get_product( $parent_product_id );
				$review_link    = $parent_product->get_permalink();
			}

			$review_link = apply_filters( 'bwfan_product_review_link', $review_link . $review_hash_path, $product, $order );
			?>
            <tr>
                <td class="image" width="100">
					<?php echo wp_kses_post( BWFAN_Common::get_product_image( $product, 'thumbnail', false, 100 ) ); //phpcs:ignore WordPress.Security.EscapeOutput
					?>
                </td>
                <td width="">
                    <h4 style="vertical-align:middle;"><?php echo wp_kses_post( BWFAN_Common::get_name( $product ) ); ?></h4>
                </td>
                <td align="right" class="last" width="">
                    <a href="<?php echo esc_url_raw( $review_link ); //phpcs:ignore WordPress.Security.EscapeOutput
					?>" class="autonami-button autonami-button--small">
                        <!--[if mso]>
						<i style="letter-spacing: 25px;mso-font-width:-100%;mso-text-raise:30pt" hidden>&nbsp;</i>
						<![endif]-->
                        <span style="mso-text-raise:15pt;"><?php echo apply_filters( 'bwfan_email_review_button_text', esc_html__( 'Leave a review', 'wp-marketing-automations' ), $product, $order ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?></span>
                        <!--[if mso]>
						<i style="letter-spacing: 25px;mso-font-width:-100%" hidden>&nbsp;</i>
						<![endif]-->
                    </a>
                </td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
    <!--[if mso]>
    </td>
    </tr>
    </table>
    <![endif]-->
</div>