<?php
/**
 * Plugin Name: Dev Property Listings
 * Description: Custom real estate property listings with meta fields (price, size, rooms, etc.).
 * Version:     1.0.0
 * Author:      Dev Nomi
 * Text Domain: dev-property-listings
 */

if ( ! defined( 'ABSPATH' ) ) exit; // No direct access.

define( 'DEV_PROP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DEV_PROP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Autoload class.
require_once DEV_PROP_PLUGIN_DIR . 'includes/class-dev-property-listings.php';

// Bootstrap the plugin.
function dev_init_plugin() {
    $dev_property_listings = new Dev_Property_Listings();
    $dev_property_listings->dev_run();
}
add_action( 'plugins_loaded', 'dev_init_plugin' );

// Load textdomain for translations
function dev_property_listings_load_textdomain() {
    load_plugin_textdomain( 'dev-property-listings', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'dev_property_listings_load_textdomain' );