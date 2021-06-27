<?php
/**
 * Main Plugin file.
 *
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker;

use Imagine\Imagick\Imagine;
use Imagine\Image\Point;
use Imagine\Image\Box;

/**
 * Plugin Class
 */
class Watermark {
	/**
	 * Watermark instance.
	 *
	 * @var Watermark
	 */
	private static $instance;

	/**
	 * WP Image path.
	 *
	 * @var string
	 */
	public string $path;

	/**
	 * WP Image ID.
	 *
	 * @var integer
	 */
	public int $id;

	/**
	 * WC Product SKU.
	 *
	 * @var string
	 */
	public string $sku = '';

	/**
	 * Instantiate Plugin.
	 *
	 * @return \Watermark
	 */
	public static function init() {
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
	public function run(): void {
		add_filter( 'woocommerce_product_get_image', [ $this, 'get_loop_watermark_image' ], 10, 2 );
		add_filter( 'woocommerce_single_product_image_thumbnail_html', [ $this, 'get_single_watermark_image' ], 10, 2 );
	}

	/**
	 * Return thumbnail watermark.
	 *
	 * @param string $html WP Image HTML.
	 * @param object $image WP Image object.
	 * @return string
	 */
	public function get_loop_watermark_image( string $html, object $image ): string {
		// Get image ID.
		$this->id = $image->get_image_id();

		// Return HTML watermark.
		return $this->id ? $this->get_watermark_image() : '';
	}

	/**
	 * Return thumbnail watermark
	 *
	 * @param string  $html WP Image HTML.
	 * @param integer $id WP Image ID.
	 * @return string
	 */
	public function get_single_watermark_image( string $html, int $id ): string {
		// Get image ID.
		$this->id = $id;

		// Return HTML watermark.
		return $this->id ? $this->get_watermark_image() : '';
	}

	/**
	 * Get watermark image
	 *
	 * @return string
	 */
	public function get_watermark_image(): string {
		// Create if it doesn't exist.
		if ( ! file_exists( plugin_dir_path( __DIR__ ) . '../images/woo-image-water-marker-' . $this->id . '.jpg' ) ) {
			$this->create_watermark_image();
		}

		return sprintf(
			'<img src="%1$s" />',
			plugin_dir_url( __DIR__ ) . 'images/woo-image-water-marker-' . $id . '.jpg'
		);
	}

	/**
	 * Get image's absolute path
	 *
	 * @param integer $id
	 * @return string
	 */
	public function get_image_absolute_path( int $id ): string {
		// Get absolute path
		$woo_image_url   = wp_get_attachment_url( $id );
		$img_uploads_dir = wp_upload_dir();

		$this->path = str_replace( $img_uploads_dir['baseurl'], $img_uploads_dir['basedir'], $woo_image_url );

		return $this->path;
	}
}
