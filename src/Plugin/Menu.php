<?php
/**
 * Menu Service.
 *
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker\Plugin;

use WooImageWaterMarker\Plugin\Settings;

/**
 * Menu Class.
 */
class Menu {
	/**
	 * Menu Instance.
	 *
	 * @var \Menu
	 */
	private static $instance;

	/**
	 * Get instance of Class (Singleton).
	 *
	 * @return \Menu
	 */
	public static function get_instance(): object {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Set up Menu.
	 *
	 * @return void
	 */
	public function init(): void {
		// Parent Menu.
		add_menu_page(
			__( Settings::NAME, Settings::DOMAIN ),
			__( Settings::NAME, Settings::DOMAIN ),
			Settings::ROLE,
			Settings::SLUG,
			false,
			'dashicons-format-image',
			99
		);

		// Dashboard Sub Menu.
		add_submenu_page(
			Settings::SLUG,
			__( Settings::NAME, Settings::DOMAIN ),
			__( 'Dashboard', Settings::DOMAIN ),
			Settings::ROLE,
			Settings::SLUG,
			[ $this, 'register_menu_page' ]
		);
	}

	/**
	 * Register Menu page.
	 *
	 * @return void
	 */
	public function register_menu_page(): void {
		echo '';
	}
}
