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
	public function get_watermark_image( int $id ): string {
		// No need to re-render, displayed cached images if they exist
		if ( file_exists( plugin_dir_path( __DIR__ ) . '../images/woo-image-water-marker-' . $id . '.jpg' ) ) {
			return sprintf(
				'<img src="%1$s" />',
				plugin_dir_url( __DIR__ ) . 'images/woo-image-water-marker-' . $id . '.jpg'
			);
		}

		// Prepare dynamic image
		$imagine = new Imagine();

		// Get absolute path...
		$this->get_image_absolute_path( $id );
		$this->image = $imagine->open( $this->path );

		// Get Product SKU
		global $product;
		$product_sku = $product->get_sku();

		// Get Watermark logo
		$logo = new WatermarkLogo( $this );
		$logo->centralize();

		// Get Watermark Text
		$text = new WatermarkText( $this );
		$text->set_text( $product_sku );

		// Save final Watermark image
		$this->image->save( __DIR__ . '/../images/woo-image-water-marker-' . $id . '.jpg' );

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
