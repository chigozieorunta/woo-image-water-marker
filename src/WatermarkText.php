<?php
/**
 * Watermark Text.
 *
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker;

use Imagine\Imagick\Imagine;
use Imagine\Gd\Font;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Imagick\Image;

/**
 * WatermarkText Class.
 */
class WatermarkText {
	/**
	 * Text font.
	 *
	 * @var \Font
	 */
	public Font $font;

	/**
	 * Text box.
	 *
	 * @var \Box
	 */
	public Box $text_box;

	/**
	 * Image Canvas.
	 *
	 * @var \Image
	 */
	public $font;

	/**
	 * Background color.
	 *
	 * @var string
	 */
	public $bg_color;

	/**
	 * Text color.
	 *
	 * @var string
	 */
	public $tx_color;

	/**
	 * Text box.
	 *
	 * @var object
	 */
	public $text_box;

	/**
	 * Image Canvas.
	 *
	 * @var object
	 */
	public $image;

	/**
	 * Text constructor
	 *
	 * @param \Watermark $watermark Watermark instance.
	 */
	public function __construct( Watermark $watermark ) {
		// RGB.
		$palette = new RGB();

		// Get Background Image.
		$this->image = $watermark->image;

		// Set colors.
		$this->bg_color = $palette->color( '#B3B3B3', 100 );
		$this->tx_color = $palette->color( '#FFFFFF', 100 );
		$this->text_box = new Box( 85, 35 );

		// Prepare Text box.
		$font_size  = 20;
		$font_file  = __DIR__ . '/../fonts/AvertaDemo-Regular.otf';
		$this->font = new Font( $font_file, $font_size, $this->tx_color );
	}

	/**
	 * Set text on canvas.
	 *
	 * @param string $string Text string.
	 * @return void
	 */
	public function set_text( $string ) {
		// Create Imagine object.
		$imagine = new Imagine();

		// Draw text on canvas.
		$this->canvas = $imagine->create( $this->text_box, $this->bg_color );
		$this->canvas->draw()->text( $string, $this->font, new Point( 0, 0 ) );

		// Get top right position of background image.
		$image_size = $this->image->getSize();
		$position   = $image_size->getWidth() - 85;

		// Paste image.
		$this->image->paste( $this->canvas, new Point( $position, 0 ) );
	}
}
