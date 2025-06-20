<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$currency = is_array( $data ) && isset( $data['currency'] ) ? $data['currency'] : '';

/** checking if woocommerce exists other wise return */
if ( ! function_exists( 'bwfan_is_woocommerce_active' ) || ! bwfan_is_woocommerce_active() ) {
	return;
}

add_action( 'bwfan_output_email_style', function () { ?>
    .bwfan-email-product-rows .bwfan-product-rows {
    width: 100%;
    border: 2px solid #e5e5e5;
    border-collapse: collapse;
    max-width:700px;
    }
    #body_content .bwfan-email-product-rows .bwfan-product-rows td {
    padding: 10px 12px;
    }
<?php } );

if ( is_array( $products ) ) : ?>
    <div class='bwfan-email-product-rows bwfan-email-table-wrap'>
        <!--[if mso]>
        <table>
            <tr>
                <td width="700">
        <![endif]-->
        <table cellspacing="0" cellpadding="0" style="width: 100%;" class="bwfan-product-rows">
            <tbody>
			<?php
			$disable_product_link      = BWFAN_Common::disable_product_link();
			$disable_product_thumbnail = BWFAN_Common::disable_product_thumbnail();

			if ( false !== $cart ) {
				$cartItemLinkEnabled = apply_filters( 'bwfan_block_editor_enable_cart_item_link', true );
				$suffix              = BWFAN_Common::get_wc_tax_label_if_displayed();
				foreach ( $cart as $item ) :
					$product = isset( $item['data'] ) ? $item['data'] : '';
					if ( empty( $product ) || ! $product instanceof WC_Product ) {
						continue; // don't show items if there is no product
					}
					$price      = isset( $products_price[ $product->get_id() ] ) ? $products_price[ $product->get_id() ] : null;
					$line_total = is_null( $price ) ? BWFAN_Common::get_prices_with_tax( $product ) : $price;
					?>
                    <tr>
						<?php if ( false === $disable_product_thumbnail ) : ?>
                            <td class="image" width="100">
								<?php if ( true === $cartItemLinkEnabled ) :
									$cartItemLink = BWFAN_Common::decode_merge_tags( apply_filters( 'bwfan_block_editor_alter_cart_item_link', '{{cart_recovery_link}}' ) );
									?>
                                    <a href="<?php echo esc_url( $cartItemLink ); ?>" target="_blank">
										<?php echo wp_kses_post( BWFAN_Common::get_product_image( $product, 'thumbnail', false, 100 ) ); ?>
                                    </a>
								<?php else : ?>
									<?php echo wp_kses_post( BWFAN_Common::get_product_image( $product, 'thumbnail', false, 100 ) ); ?>
								<?php endif; ?>
                            </td>
						<?php endif; ?>
                        <td width="">
                            <h4 style="vertical-align:middle;"><?php echo wp_kses_post( BWFAN_Common::get_name( $product ) ); ?></h4>
                        </td>
                        <td align="right" class="last" width="100">
	                        <?php if( false === BWFAN_Merge_Tag_Loader::get_data( 'is_preview' ) ): ?>
		                        <?php
		                        	echo wp_kses_post( BWFAN_Common::price( $line_total, $currency ) );
		                        ?>
		                        <?php if ( $suffix && wc_tax_enabled() ): ?>
									<small><?php echo $suffix; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></small>
		                        <?php endif; ?>
	                        <?php else: ?>
								<?php echo $price; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	                        <?php endif; ?>
                        </td>
                    </tr>
				<?php endforeach;
			} else {
				foreach ( $products as $product ) {
					if ( ! $product instanceof WC_Product ) {
						continue;
					}
					$price      = isset( $products_price[ $product->get_id() ] ) ? $products_price[ $product->get_id() ] : null;
					$line_total = is_null( $price ) ? BWFAN_Common::get_prices_with_tax( $product ) : $price;
					?>
                    <tr>
						<?php
						if ( true === $disable_product_link ) {
							if ( false === $disable_product_thumbnail ) {
								?>
                                <td class="image" width="100">
									<?php echo wp_kses_post( BWFAN_Common::get_product_image( $product, 'thumbnail', false, 100 ) ); //phpcs:ignore WordPress.Security.EscapeOutput ?>
                                </td>
								<?php
							} ?>
                            <td width="">
                                <h4 style="margin:0;"><?php echo wp_kses_post( BWFAN_Common::get_name( $product ) ); ?></h4>
                            </td>
							<?php
						} else {
							if ( false === $disable_product_thumbnail ) {
								?>
                                <td class="image" width="100">
                                    <a href="<?php echo esc_url_raw( $product->get_permalink() ); //phpcs:ignore WordPress.Security.EscapeOutput ?>"><?php echo wp_kses_post( BWFAN_Common::get_product_image( $product, 'thumbnail', false, 100 ) ); //phpcs:ignore WordPress.Security.EscapeOutput ?></a>
                                </td>
								<?php
							}
							?>
                            <td width="">
                                <h4 style="margin:0;">
                                    <a href="<?php echo esc_url_raw( $product->get_permalink() ); //phpcs:ignore WordPress.Security.EscapeOutput ?>"><?php echo wp_kses_post( BWFAN_Common::get_name( $product ) ); ?></a>
                                </h4>
                            </td>
							<?php
						}
						?>
                        <td align="right" class="last" width="">
                            <p class="price" style="margin: 18px 0 8px;"><?php echo wp_kses_post( BWFAN_Common::price( $line_total ) ); //phpcs:ignore WordPress.Security.EscapeOutput ?></p>
                        </td>
                    </tr>
					<?php
				}
			}
			?>
            </tbody>
        </table>
        <!--[if mso]>
        </td></tr></table>
        <![endif]-->
    </div>
<?php endif;
