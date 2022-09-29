<?php
/**
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker;

use Imagine\Imagick\Imagine;

/**
 * Plugin Class
 */
class Plugin {
	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Imagine Object
	 *
	 * @var object
	 */
	private object $imagine;

	/**
	 * Instantiate Plugin
	 *
	 * @return object
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
	public function activate() : void {
		add_filter( 'init', [ $this, 'get_imagine' ] );
		add_filter( 'woocommerce_product_get_image', [ $this, 'get_image_watermark_html' ], 10, 2 );
		//add_filter( 'woocommerce_single_product_image_thumbnail_html', [ $this, 'get_image_watermark_html' ] );
	}

	/**
	 * Register Imagine Object
	 *
	 * @return void
	 */
	public function get_imagine() : void {
		$imagine = new Imagine();
		$imagine->open( __DIR__ . '/images/gozie.jpg' );
		$imagine->save( __DIR__ . '/images/woo-image-water-marker.jpg' );
		$this->imagine = $imagine;
	}

	/**
	 * Return thumbnail watermark
	 *
	 * @return string
	 */
	public function get_image_watermark_html( string $img_html, object $image ) : string {
		// Get image ID
		$woo_image = wp_get_attachment_image_url( $image->get_image_id(), 'woocommerce_thumbnail' );

		// Get Imagine object
		//$imagine = new Imagine();
		//$imagine = new \Imagine\Imagick\Imagine();
		//$imagine->open( __DIR__ . '/images/gozie.jpg' );

		//$watermark = $imagine->open( __DIR__ . '/images/watermark.jpeg' );
		//$image     = $imagine->open( $woo_image );
		//$size      = $image->getSize();
		//$wSize     = $watermark->getSize();

		//$bottomRight = new Imagine\Image\Point( $size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight() );
		//$image->paste( $watermark );
		//$image->save( __DIR__ . '/images/woo-image-water-marker.jpg' );

		/*return sprintf(
			'<img src="%1$s" />',
			plugin_dir_url( __DIR__ ) . 'images/woo-image-water-marker.jpg'
		);*/
		return '';
	}
}
