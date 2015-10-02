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

class ModelTest extends \PHPUnit_Framework_TestCase {


	/**
	 * @expectedException DatabaseException;
	 */
	public function testModelCanBeCreated()
	{
		$comment = new Comment();
		$comment->user = "verem";
		$comment->body = "this is a test comment";
		$comment->created_at = time();
		$comment->updated_at = time();

		$comment->save();
	}

	public function testModelCanBeFound()
	{

	}

	public function testModelCanBeDeleted()
	{

	}

	public function testModelCanBeFoundWithColumn()
	{

	}
}
