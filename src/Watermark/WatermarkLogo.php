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
	 * Logo's X position.
	 *
	 * @var integer
	 */
	public int $x = 0;

	/**
	 * Logo's Y Position.
	 *
	 * @var integer
	 */
	public int $y = 0;

	/**
	 * Watermark object.
	 *
	 * @var \Watermark
	 */
	public $watermark;

	public function __construct( Watermark $watermark ) {
		$imagine     = new Imagine();
		$this->image = $watermark->image;
		$this->logo  = $imagine->open( __DIR__ . '/../../assets/images/watermark.png' );
	}

	/**
	 * Set logo.
	 *
	 * @return void
	 */
	public function set(): void {
		// Resize logo first.
		$this->resize_logo();

		// Set logo in center position.
		$this->set_position();
	}

	public function set_position(): void {
		// Get Position.
		list($this->x, $this->y) = $this->get_position();

		// Set Position of logo.
		$this->image->paste( $this->logo, new Point( $this->x, $this->y ) );
	}

	public function get_position(): array {
		// Get sizes of logo and image.
		$logo_size  = $this->logo->getSize();
		$image_size = $this->image->getSize();

		switch ( apply_filters( 'wiwm_logo_position', 'center' ) ) {
			case 'top-left':
				$coordinates[] = 0;
				$coordinates[] = 0;
				break;

			case 'top-right':
				$coordinates[] = ( $image_size->getWidth() - $logo_size->getWidth() );
				$coordinates[] = 0;
				break;

			case 'bottom-left':
				$coordinates[] = 0;
				$coordinates[] = ( $image_size->getHeight() - $logo_size->getHeight() );
				break;

		// Paste to location
		$this->image->paste( $this->logo, new Point( $middle_x, $middle_y ) );
	}

	/**
	 * Set Position.
	 *
	 * @param integer $x X Position.
	 * @param integer $y Y Position.
	 * @return void
	 */
	public function set_position( int $x, int $y ): void {
		// Paste to position.
		$this->image->paste( $this->logo, new Point( $x, $y ) );
	}
}
