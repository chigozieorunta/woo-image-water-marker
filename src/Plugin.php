<?php
/**
 * Plugin entry point.
 *
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker;

use WooImageWaterMarker\Watermark\Watermark;

/**
 * Plugin Class
 */
class Plugin {
	/**
	 * Plugin instance.
	 *
	 * @var Plugin
	 */
	private static $instance;

	/**
	 * Instantiate Plugin.
	 *
	 * @return \Plugin
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Run Watermark plugin.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_assets' ] );
		$watermark = Watermark::get_instance();
		$watermark->run();
	}
}
