<?php
/**
 * Watermark Text.
 *
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker\Watermark;

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
	 * @var \Imagine\Image\ImagineInterface
	 */
	public $text_box;

	/**
	 * Image Canvas.
	 *
	 * @var \Image
	 */
	public Image $image;

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
	 * WC Product SKU.
	 *
	 * @var string
	 */
	public string $sku;

	/**
	 * Text String.
	 *
	 * @var string
	 */
	public string $text;

	/**
	 * Text constructor
	 *
	 * @param \Watermark $watermark Watermark instance.
	 */
	public function __construct( Watermark $watermark ) {
		// Get image.
		$this->image = $watermark->image;
		$this->sku   = $watermark->sku ?: '';

		// Set colors and font.
		$this->set_colors();
		$this->set_font();
	}

	/**
	 * Set text on canvas.
	 *
	 * @param string $text Text string.
	 * @return void
	 */
	public function set( $text = '' ): void {
		// Get SKU or string.
		$this->text = $text ?: $this->sku;

		// Create text box and set position.
		$this->set_text_box();
		$this->set_position();
	}

	/**
	 * Set colors.
	 *
	 * @return void
	 */
	public function set_colors(): void {
		// Set colors.
		$palette        = new RGB();
		$this->bg_color = $palette->color( apply_filters( 'wiwm_text_bgcolor', '#B3B3B3' ), 100 );
		$this->tx_color = $palette->color( apply_filters( 'wiwm_text_txcolor', '#FFFFFF' ), 100 );
	}

	/**
	 * Set font.
	 *
	 * @return void
	 */
	public function set_font(): void {
		// Set font.
		$font_size  = apply_filters( 'wiwm_text_size', 20 );
		$font_type  = apply_filters( 'wiwm_text_font', __DIR__ . '/../../assets/fonts/AvertaDemo-Regular.otf' );
		$this->font = new Font( $font_type, $font_size, $this->tx_color );
	}

	/**
	 * Set text box.
	 *
	 * @return void
	 */
	public function set_text_box(): void {
		// Get Imagine object.
		$imagine = new Imagine();

		// Set text box.
		$empty_text_canvas = new Box( 85, 35 );
		$this->text_box    = $imagine->create( $empty_text_canvas, $this->bg_color );
		$this->text_box->draw()->text( $this->text, $this->font, new Point( 0, 0 ) );
	}

	/**
	 * Set position.
	 *
	 * @return void
	 */
	public function set_position(): void {
		// Get top right position of image.
		$image_size = $this->image->getSize();
		$position   = $image_size->getWidth() - 85;

		// Set text position.
		$this->image->paste( $this->text_box, new Point( $position, 0 ) );
	}
}
