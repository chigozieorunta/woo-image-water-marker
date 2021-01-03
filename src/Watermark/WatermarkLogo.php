<?php
/**
 * @package WooImageWaterMarker
 */

namespace WooImageWaterMarker\Watermark;

use Imagine\Imagick\Imagine;
use Imagine\Image\Point;
use Imagine\Image\Box;
use Imagine\Imagick\Image;

/**
 * WatermarkLogo Class
 */
class WatermarkLogo {

	/**
	 * Imagine Object for image.
	 *
	 * @var \Image
	 */
	public Image $image;

	/**
	 * Imagine Object for logo.
	 *
	 * @var \Image
	 */
	public Image $logo;

	/**
	 * Watermark object.
	 *
	 * @var \Watermark
	 */
	public $watermark;

	public function __construct( Watermark $watermark ) {
		$imagine = new Imagine();

		$this->image = $watermark->image;
		$this->logo  = $imagine->open( __DIR__ . '/../assets/images/watermark.png' );
	}

	/**
	 * Set Location
	 *
	 * @param integer $x
	 * @param integer $y
	 * @return \Point
	 */
	public function location( int $x, int $y ) {
		// Paste to location
		$this->image->paste( $this->logo, new Point( $x, $y ) );

		return $this;
	}

	/**
	 * Set logo.
	 *
	 * @return void
	 */
	public function set(): void {
		// Get sizes
		$logo_size  = $this->logo->getSize();
		$image_size = $this->image->getSize();

		// Get ratio
		$ratio = $logo_size->getWidth() / $logo_size->getHeight();

		// Get new width and height
		$new_width  = $image_size->getWidth() / 2;
		$new_height = $new_width / $ratio;

		// Resize & rescale logo to fit half of image width
		$this->logo->resize( new Box( $new_width, $new_height ) );

		// Get size of resized logo
		$logo_size = $this->logo->getSize();

		// Get middle positions for resized logo
		$middle_x = ( $image_size->getWidth() - $logo_size->getWidth() ) / 2;
		$middle_y = ( $image_size->getHeight() - $logo_size->getHeight() ) / 2;

		// Paste to location
		$this->image->paste( $this->logo, new Point( $middle_x, $middle_y ) );

		return $this;
	}
}
