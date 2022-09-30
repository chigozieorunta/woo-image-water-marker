<?php

/**
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker;

//use Imagine\Gd\Imagine;
use Imagine\Imagick\Imagine;
use Imagine\Gd\Font;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * WatermarkText Class
 */
class WatermarkText {

	public $font;
	public $bg_color;
	public $tx_color;
	public $image_box;
	public $image;

	public function __construct(Watermark $watermark) {
		// RGB
		$palette = new RGB();

		// Get Background Image
		$this->image = $watermark->image;

		// Set colors
		$this->bg_color  = $palette->color('#B3B3B3', 100);
		$this->tx_color  = $palette->color('#FFFFFF', 100);
		$this->image_box = new Box(85, 35);

		// Prepare Text box
		$font_size  = 20;
		$font_file  = __DIR__ . '/../fonts/AvertaDemo-Regular.otf';
		$this->font = new Font($font_file, $font_size, $this->tx_color);
	}

	public function set_text($string) {
		// Imagine
		$imagine = new Imagine();

		// Draw text on canvas
		$this->canvas = $imagine->create($this->image_box, $this->bg_color);
		$this->canvas->draw()->text($string, $this->font, new Point(0, 0));

		// Get top right position of background image
		$image_size = $this->image->getSize();
		$position   = $image_size->getWidth() - 85;

		// Paste image
		$this->image->paste($this->canvas, new Point($position, 0));
	}
}
		//$position = $woo_image_size->getWidth() - 80;
