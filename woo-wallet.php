<?php
/**
 * Plugin Name: Athar Wallet System
 * Plugin URI: https://youesf-abdallah.online/
 * Description: A powerful wallet plugin for WooCommerce with partial payment, refunds, cashbacks and more!
 * Version: 1.5.14
 * Requires Plugins: woocommerce
 * Author: Yousef Abdallah
 * Author URI: https://youesf-abdallah.online/
 * Text Domain: woo-wallet
 * Domain Path: /languages/
 * Requires at least: 6.4
 * Tested up to: 6.8
 *
 * @package AtharWallet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define WOO_WALLET_PLUGIN_FILE.
if ( ! defined( 'WOO_WALLET_PLUGIN_FILE' ) ) {
	define( 'WOO_WALLET_PLUGIN_FILE', __FILE__ );
}

// Define WOO_WALLET_ABSPATH.
if ( ! defined( 'WOO_WALLET_ABSPATH' ) ) {
	define( 'WOO_WALLET_ABSPATH', dirname( WOO_WALLET_PLUGIN_FILE ) . '/' );
}

// Define WOO_WALLET_PLUGIN_VERSION.
if ( ! defined( 'WOO_WALLET_PLUGIN_VERSION' ) ) {
	define( 'WOO_WALLET_PLUGIN_VERSION', '1.5.14' );
}

// include dependencies file.
if ( ! class_exists( 'Woo_Wallet_Dependencies' ) ) {
	include_once __DIR__ . '/includes/class-woo-wallet-dependencies.php';
}

// Include the main class.
if ( ! class_exists( 'Woo_Wallet' ) ) {
	include_once __DIR__ . '/includes/class-woo-wallet.php';
}
/**
 * Returns the main instance of Woo_Wallet.
 *
 * @since  1.1.0
 * @return Woo_Wallet
 */
function woo_wallet() {
	return Woo_Wallet::instance();
}

$GLOBALS['woo_wallet'] = woo_wallet();
