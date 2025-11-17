// Add this to handle_wallet_balance_adjustment function starting at line 675:

// Check for new_balance field
$new_balance = isset( $_POST['new_balance'] ) ? sanitize_text_field( wp_unslash( $_POST['new_balance'] ) ) : '';

// Then modify the validation at line 689:
} elseif ( empty( $new_balance ) && ( is_null( $amount ) || empty( $amount ) ) ) {
    $response = array(
        'type'    => 'error',
        'message' => __( 'Please enter either a new balance or an amount to add/subtract', 'woo-wallet' ),
    );
} elseif ( ! empty( $new_balance ) ) {
    // Handle "Set New Balance" method
    $new_balance     = apply_filters( 'woo_wallet_set_new_balance_amount', number_format( $new_balance, wc_get_price_decimals(), '.', '' ), $user_id );
    $current_balance = woo_wallet()->wallet->get_wallet_balance( $user_id, 'edit' );
    $difference      = floatval( $new_balance ) - floatval( $current_balance );

    if ( $difference !== 0 ) {
        $desc = ! empty( $description ) ? $description : sprintf( __( 'Balance adjusted to %s', 'woo-wallet' ), wc_price( $new_balance, woo_wallet_wc_price_args( $user_id ) ) );

        if ( $difference > 0 ) {
            $transaction_id = woo_wallet()->wallet->credit( $user_id, $difference, $desc );
        } else {
            $transaction_id = woo_wallet()->wallet->debit( $user_id, abs( $difference ), $desc );
        }

        if ( $transaction_id ) {
            do_action( 'woo_wallet_admin_adjust_balance', $transaction_id );
            $response = array(
                'type'    => 'success',
                'message' => sprintf(
                    __( 'Wallet balance for %2$s has been set to %1$s. <a href="%3$s">View all transactions&rarr;</a>', 'woo-wallet' ),
                    wc_price( $new_balance, woo_wallet_wc_price_args( $user_id ) ),
                    $user->user_login,
                    add_query_arg(
                        array(
                            'page'    => 'woo-wallet-transactions',
                            'user_id' => $user_id,
                        ),
                        admin_url( 'admin.php' )
                    )
                ),
            );
        } else {
            $response = array(
                'type'    => 'error',
                'message' => __( 'There may be some issue with database connection. Please deactivate Athar Wallet plugin and activate again.', 'woo-wallet' ),
            );
        }
    } else {
        $response = array(
            'type'    => 'success',
            'message' => sprintf(
                __( 'Balance for %s is already %s. No changes made.', 'woo-wallet' ),
                $user->user_login,
                wc_price( $new_balance, woo_wallet_wc_price_args( $user_id ) )
            ),
        );
    }
} else {
    // Continue with existing code starting from line 694
