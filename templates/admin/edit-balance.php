<?php
/**
 * Admin View: Edit wallet balance popup.
 *
 * @package AtharWallet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="woo-wallet-edit-balance-tb-content" style="padding: 20px;">
	<section class="woo-wallet-edit-balance-tb-main">
		<form method="post">
			<header style="margin-bottom: 20px;">
				<h1 style="margin: 0 0 10px 0; font-size: 22px;"><?php echo esc_html( __( 'Edit balance', 'woo-wallet' ) ); ?></h1>
				<button class="modal-close modal-close-link dashicons dashicons-no-alt" onclick="javascript:tb_remove()" type="button" style="position: absolute; top: 15px; right: 15px;">
					<span class="screen-reader-text"><?php esc_html_e( 'Close modal panel', 'woo-wallet' ); ?></span>
				</button>
			</header>
			<fieldset style="padding: 15px 0;">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="balance_amount"><?php /* translators: 1: WooCommerce currency symbol. */ echo esc_html( sprintf( __( 'Current balance: %s', 'woo-wallet' ), get_woocommerce_currency_symbol() ) ); ?></label></th>
							<td>
								<input type="number" step="any" name="balance_amount" id="balance_amount" class="regular-text" value="<?php echo esc_attr( woo_wallet()->wallet->get_wallet_balance( $user_id, 'edit' ) ); ?>" placeholder="<?php esc_html_e( 'Enter new balance', 'woo-wallet' ); ?>" />
								<p style="margin: 5px 0 0; font-size: 12px; color: #666;">
									<?php esc_html_e( 'Edit this field to set the new balance for this user.', 'woo-wallet' ); ?>
								</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="payment_type"><?php esc_html_e( 'Type', 'woo-wallet' ); ?></label></th>
							<td>
								<?php
								$payment_types = apply_filters(
									'woo_wallet_adjust_balance_payment_type',
									array(
										'credit' => __( 'Credit', 'woo-wallet' ),
										'debit'  => __( 'Debit', 'woo-wallet' ),
									)
								);
								?>
								<select class="regular-text" name="payment_type" id="payment_type">
									<?php foreach ( $payment_types as $key => $value ) : ?>
									<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
									<?php endforeach; ?>
								</select>
								<p style="margin: 5px 0 0; font-size: 12px; color: #666;">
									<?php esc_html_e( 'Select Credit to add or Debit to subtract.', 'woo-wallet' ); ?>
								</p>
							</td>
						</tr>
						<?php do_action( 'woo_wallet_after_payment_type_field' ); ?>
						<tr>
							<th scope="row"><label for="payment_description"><?php esc_html_e( 'Description', 'woo-wallet' ); ?></label></th>
							<td>
								<textarea name="payment_description" class="regular-text" placeholder="<?php esc_html_e( 'Enter description', 'woo-wallet' ); ?>"></textarea>
								<p style="margin: 5px 0 0; font-size: 12px; color: #666;">
									<?php esc_html_e( 'Add a note about this balance adjustment.', 'woo-wallet' ); ?>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
			<footer style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #ddd;">
				<div class="inner">
					<input type="hidden" name="user_id" value="<?php echo esc_attr( $user_id ); ?>" />
					<?php wp_nonce_field( 'woo-wallet-admin-adjust-balance', 'woo-wallet-admin-adjust-balance' ); ?>
					<?php submit_button( __( 'Update balance', 'woo-wallet' ), 'primary', 'submit', false ); ?>
				</div>
			</footer>
		</form>
	</section>
</div>
