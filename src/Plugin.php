<?php
/**
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker;

use Imagine\Imagick\Imagine;
use Imagine\Image\Point;
use Imagine\Image\Box;

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
	public Imagine $imagine;

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
		$this->imagine = new Imagine();

		add_filter( 'woocommerce_product_get_image', [ $this, 'get_loop_watermark_image' ], 10, 2 );
		add_filter( 'woocommerce_single_product_image_thumbnail_html', [ $this, 'get_single_watermark_image' ], 10, 2 );
	}

	/**
	 * Return thumbnail watermark
	 *
	 * @param string $html
	 * @param object $image
	 * @return string
	 */
	public function get_loop_watermark_image( string $html, object $image ) : string {
		// Get image ID
		$id = $image->get_image_id();

		// Return HTML watermark
		return $this->get_watermark_image( $id, $this->imagine );
	}

	/**
	 * Return thumbnail watermark
	 *
	 * @param string $html
	 * @param integer $id
	 * @return string
	 */
	public function get_single_watermark_image( string $html, int $id ) : string {
		// Return HTML watermark
		return $this->get_watermark_image( $id, $this->imagine );
	}

	/**
	 * Get watermark image
	 *
	 * @param integer $id
	 * @param Imagine $imagine
	 * @return string
	 */
	public function get_watermark_image( int $id, Imagine $imagine ) : string {
		// Get WC image, watermark and imagine lib
		$image_path = $this->get_image_absolute_path( $id );
		$image      = $imagine->open( $image_path );
		$watermark  = $imagine->open( __DIR__ . '/../images/watermark.png' );

		// Paste watermark in center position
		$position = $this->set_center( $watermark, $image );
		$image->paste( $watermark, $position );

		// Save final Watermark image
		$image->save( __DIR__ . '/../images/woo-image-water-marker-' . $id . '.jpg' );

		return sprintf(
			'<img src="%1$s" />',
			plugin_dir_url( __DIR__ ) . 'images/woo-image-water-marker-' . $id . '.jpg',
			$product_sku
		);
	}

	/**
	 * Get image's absolute path
	 *
	 * @param integer $id
	 * @return string
	 */
	public function get_image_absolute_path( int $id ) : string {
		// Get relative path
		$woo_image = wp_get_attachment_image_url( $id, 'woocommerce_thumbnail' );

		// Get absolute path
		$woo_image_url   = wp_get_attachment_url( $id );
		$img_uploads_dir = wp_upload_dir();

		return str_replace( $img_uploads_dir['baseurl'], $img_uploads_dir['basedir'], $woo_image_url );
	}

	/**
	 * Set watermark in center position
	 *
	 * @param Imagine $watermark
	 * @param Imagine $image
	 * @return Point
	 */
	public function set_center( $watermark, $image ) {
		// Get sizes
		$image_size     = $image->getSize();
		$watermark_size = $watermark->getSize();

		// Resize & rescale watermark to fit half of image width
		$ratio      = $watermark_size->getWidth() / $watermark_size->getHeight();
		$new_width  = $image_size->getWidth() / 2;
		$new_height = $new_width / $ratio;
		$watermark->resize( new Box( $new_width, $new_height ) );

		// Get middle positions for watermark
		$watermark_size = $watermark->getSize();
		$middle_x = ( $image_size->getWidth() - $watermark_size->getWidth() ) / 2;
		$middle_y = ( $image_size->getHeight() - $watermark_size->getHeight() ) / 2;

		// Return point object
		return new Point( $middle_x, $middle_y );
	}

	public function get_watermark() {

	}

	public function get_textmark() {
		// Product SKU
		/*global $product;
		$product_sku = $product->get_sku();

		// Create required instances...
		$settings = array(
			'text'      => $product_sku ?: 'SKU',
			'width'     => 80,
			'height'    => 35,
			'font_size' => 20,
			'font_file' => __DIR__ . '/fonts/AvertaDemo-Regular.otf',
			'tx_color'  => '#ffffff',
			'bg_color'  => '#b3b3b3',
		);

		$imagine_gd = new \Imagine\Gd\Imagine();
		$palette    = new \Imagine\Image\Palette\RGB();

		$bg_color  = $palette->color($settings['bg_color'], 100);
		$tx_color  = $palette->color($settings['tx_color'], 100);
		$image_box = new \Imagine\Image\Box($settings['width'], $settings['height']);
		$text_font = new \Imagine\Gd\Font($settings['font_file'], $settings['font_size'], $tx_color);
		$text_box  = $text_font->box($settings['text']);

		$woo_sku = $imagine->create($image_box, $bg_color);
		$woo_sku->draw()->text($settings['text'], $text_font, new \Imagine\Image\Point(0, 0));
		$sku_position = $woo_image_size->getWidth() - 80;

		// Paste SKU
		$woo_image->paste($woo_sku, new \Imagine\Image\Point($sku_position, 0)); */
	}
}
