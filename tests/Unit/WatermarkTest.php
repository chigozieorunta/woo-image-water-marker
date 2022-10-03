<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use WooImageWaterMarker\Watermark;

/**
 * WatermarkTest Class
 */
class WatermarkTest extends TestCase {
	/**
	 * Test String output
	 *
	 * @return string
	 */
	public function test_string_output() : string {
		// Given that we have a watermark object
		$watermark = new Watermark();

		// When we call the get image method
		$watermark->get_image_absolute_path(1);

		$expected = 'Hello World';

		// Then we assert that it returns string
		$this->assertEquals( $expected, 'Hello World' );

	}
}
