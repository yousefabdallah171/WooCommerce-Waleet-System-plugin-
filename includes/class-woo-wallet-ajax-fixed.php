<?php
/**
 * Plugin ajax file
 *
 * @package AtharWallet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! class_exists( 'Woo_Wallet_Ajax' ) ) {
	/**
	 * Plugin Ajax class
	 */
	class Woo_Wallet_Ajax {

		/**
		 * The single instance of the class.
		 *
		 * @var Woo_Wallet_Ajax
		 * @since 1.1.10
		 */
		protected static $_instance = null;

		/**
		 * Main instance
		 *
		 * @return class object
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Class constructor
		 */
		public function __construct() {
			add_action( 'wp_ajax_woo_wallet_order_refund', array( $this, 'woo_wallet_order_refund' ) );
			add_action( 'wp_ajax_woocommerce_wallet_rated', array( $this, 'woocommerce_wallet_rated' ) );
			add_action( 'wp_ajax_woo-wallet-user-search', array( $this, 'woo_wallet_user_search' ) );
			add_action( 'wp_ajax_woo_wallet_partial_payment_update_session', array( $this, 'woo_wallet_partial_payment_update_session' ) );
			add_action( 'wp_ajax_woo_wallet_refund_partial_payment', array( $this, 'woo_wallet_refund_partial_payment' ) );
			add_action( 'wp_ajax_woo-wallet-dismiss-promotional-notice', array( $this, 'woo_wallet_dismiss_promotional_notice' ) );
			add_action( 'wp_ajax_draw_wallet_transaction_details_table', array( $this, 'draw_wallet_transaction_details_table' ) );

			add_action( 'woocommerce_order_after_calculate_totals', array( $this, 'recalculate_order_cashback_after_calculate_totals' ), 10, 2 );

			add_action( 'wp_ajax_terawallet_export_user_search', array( $this, 'terawallet_export_user_search' ) );

			add_action( 'wp_ajax_terawallet_do_ajax_transaction_export', array( $this, 'terawallet_do_ajax_transaction_export' ) );

			add_action( 'wp_ajax_lock_unlock_terawallet', array( $this, 'lock_unlock_terawallet' ) );

			add_action( 'wp_ajax_get_edit_wallet_balance_template', array( $this, 'edit_wallet_balance_template' ) );
			add_action( 'wp_ajax_get_add_wallet_balance_template', array( $this, 'add_wallet_balance_template' ) );
		}
