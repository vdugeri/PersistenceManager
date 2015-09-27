<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/27/15
 * Time: 4:31 PM
 */

namespace Verem\persistence\Test;


use Verem\persistence\UserRole;

class ModelTest extends \PHPUnit_Framework_TestCase {


	/**
	 * @param $actual
	 * @param $expected
	 *
	 */
	public function testModelMapsToTable()
	{
		$userRole = new UserRole();
		$this->assertEquals('user_roles', $userRole->getTable());

	}

	/**
	 * Provide test data for testModelMapsToTable method
	 *
	 * @return array
	 */
	public function modelProvider()
	{
		return [
			['UserRole', 'user_roles'],
			['User', 'users'],
			['Chop', 'chops'],
			['Comment', 'comments'],
			['Post', 'posts'],
			['Child', 'children']
		];
	}
}
