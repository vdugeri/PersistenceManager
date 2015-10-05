<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/2/15
 * Time: 10:42 AM
 */

namespace Verem\persistence\Test;


use Verem\persistence\Comment;
use Verem\Persistence\Exceptions\DatabaseException;
use Mockery;
use Verem\User;

class ModelTest extends \PHPUnit_Framework_TestCase {


	/**
	 * @expectedException DatabaseException;
	 */
	public function testModelCanBeCreated()
	{

/*		$mock = Mockery::mock('Verem\User');
		$mock->shouldReceive('p')
			->once()
		->andReturn(1);
*/
		$user = new User();
		$user->username = "verem";
		$user->password = "password";
		$inserted =$user->save();

		$this->assertTrue($inserted);
	}


	public function testModelCanBeFound()
	{
		$user = new User();
		$user->username = "verem";
		$user->password = "password";
		$user->save();

		$user::find(1);
		$this->assertNotEmpty($user);
		$this->assertEquals('password', $user->password);
	}

	public function testModelCanBeDeleted()
	{
		$user = new User();
		$user->username = "verem";
		$user->password = "password";
		$user->save();

		$result = $user::destroy(1);

		$this->assertTrue($result);


	}

	public function testModelCanBeFoundWithColumn()
	{

	}
}
