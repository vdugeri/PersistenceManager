<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/26/15
 * Time: 9:30 AM
 */

namespace Verem\Persistence\Test;

use Verem\Persistence\Base\Inflect;

class InflectTest extends \PHPUnit_Framework_TestCase {

	 /**
	 * @param $expected
	 * @param $actual
	 *
	 * @dataProvider wordProvider
	 */
	 public function testWordInflection($actual, $expected )
	 {
		$this->assertEquals($expected, Inflect::pluralize($actual));
	 }

	 /**
	 * @return array
	 * data provider for the word test method
	 */
	 public function wordProvider()
	 {
		return [
			['move', 'moves'],
			['movie', 'movies'],
			['hand', 'hands'],
			['child', 'children'],
			['user', 'users'],
			['foot', 'feet'],
			['analysis', 'analyses']
		];
	 }
}