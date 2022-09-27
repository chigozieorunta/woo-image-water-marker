<?php
/**
 * Plugin Name: Woo Image Water Marker
 * Plugin URI:  https://github.com/chigozieorunta/woo-image-water-marker
 * Description: A simple plugin to help you insert water markers into WooCommerce product images.
 * Version:     1.0.0
 * Author:      Chigozie Orunta
 * Author URI:  https://linkedin.com/in/chigozieorunta
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woo-image-water-marker
 * Domain Path: /languages
 *
 * @package WooImageWaterMarker
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) )
	require_once 'vendor/autoload.php';

$plugin = \WooImageWaterMarker\Plugin::init();
$plugin->activate();
