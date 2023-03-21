<?php
/**
 * Plugin entry point.
 *
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker;

use PHPUnit\Exception;
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
		$this->register_watermark();
	}

	/**
	 * Register Watermark.
	 *
	 * @return void
	 */
	public function register_watermark(): void {
		try {
			$watermark = Watermark::get_instance();
			$watermark->run();
		} catch ( Exception $e ) {
			wp_die( 'Error: Registering Watermark - ' . $e->getMessage() );
		}
	}

	/**
	 * Register Assets.
	 *
	 * @return void
	 */
	public function register_assets(): void {
		try {
			$assets = Plugin\Assets::get_instance();
			$assets->init();
		} catch ( Exception $e ) {
			wp_die( 'Error: Registering Assets - ' . $e->getMessage() );
		}
	}

	/**
	 * Register Admin Assets.
	 *
	 * @return void
	 */
	public function register_admin_assets(): void {
		try {
			$assets = Plugin\Assets::get_instance();
			$assets->admin_init();
		} catch ( Exception $e ) {
			wp_die( 'Error: Registering Admin Assets - ' . $e->getMessage() );
		}
	}
}
