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

			case 'bottom-right':
				$coordinates[] = ( $image_size->getWidth() - $logo_size->getWidth() );
				$coordinates[] = ( $image_size->getHeight() - $logo_size->getHeight() );
				break;

			default:
				$coordinates[] = ( $image_size->getWidth() - $logo_size->getWidth() ) / 2;
				$coordinates[] = ( $image_size->getHeight() - $logo_size->getHeight() ) / 2;
		}

		return apply_filters( 'wiwm_logo_position', $coordinates );
	}

	/**
	 * Resize logo to half of the image width.
	 *
	 * @return void
	 */
	public function resize_logo(): void {
		// Get sizes.
		$logo_size  = $this->logo->getSize();
		$image_size = $this->image->getSize();

		// Get ratio.
		$ratio = $logo_size->getWidth() / $logo_size->getHeight();

		// Get new width and height of logo.
		$new_width  = $image_size->getWidth() / apply_filters( 'wiwm_logo_ratio', 2 );
		$new_height = $new_width / $ratio;

		// Set new width and height of logo.
		$this->logo->resize( new Box( apply_filters( 'wiwm_logo_width', $new_width ), apply_filters( 'wiwm_logo_height', $new_height ) ) );
	}
}
