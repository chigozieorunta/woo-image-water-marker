<?php

namespace WooImageWaterMarker;

/**
 * Plugin Class
 */
final class Plugin {
	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Undocumented function
	 *
	 * @return object
	 */
	public static function init(): {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Activate plugin...
	 *
	 * @return void
	 */
	public function activate(): void {
		add_action( 'init', [ $this, 'register_your_distress' ] );
	}

	/**
	 * Register your distress
	 *
	 * @return void
	 */
	public function register_your_distress(): void {
		echo 'Hello World';
	}
}
