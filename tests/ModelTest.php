<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/2/15
 * Time: 10:42 AM
 */

namespace Verem\Persistence\Test;



use Verem\persistence\Base\Model;
use Verem\Persistence\Exceptions\DatabaseException;
use Mockery;
use Verem\Persistence\Test\PersistenceModelFindStub;

class ModelTest extends \PHPUnit_Framework_TestCase {


	 /**
	 * Test if model can be created and properties
	 * attached to it.
	 *
	 * @expectedException DatabaseException;
	 */
	 public function testModelCanBeCreated()
	 {
		$model = new PersistenceModelSaveStub();
		$model->name = "Tester";
		$model->location = "M55";

		$properties = $model->getProperties();
		$this->assertArrayHasKey('name', $properties);
		$this->assertTrue($model->save());
		$this->assertNotEmpty($model->getProperties());
	 }

	 /**
	 * Test if the tables are set correctly for the models
	 */
	 public function testTableSetOperation()
	 {
		$connection = Mockery::mock('Verem\Persistence\Connector');
		$model = Mockery::mock('Verem\Persistence\Model');
		$model->shouldReceive('createConnection')
			->once()
			->andReturn($connection);

		$model = new PersistenceModelStub();
		$table =$model->getTable();
		$this->assertEquals('persistence_model_stubs', $table);
		$this->assertNotEquals('persistence_model_stub', $table);
	 }

	 /**
	 * Test if model attributes can be manipulated.
	 */
	 public function testAttributesCanBeManipulated()
	 {
		$model = new PersistenceModelStub();
		$model->name = "New name";

		$this->assertEquals('New name', $model->name);
		$this->assertNotEquals('No name', $model->name);
		$this->assertNotNull($model->name);

		$model = new PersistenceModelStub();
		$model->email = 'dan@example.com';
		$model->password = 'password';
		$model->name = 'Dan';

		$this->assertArrayHasKey('email', $model->getProperties());
		$this->assertNotEquals('dan', $model->name);
		$this->assertNotContains('dan', $model->getProperties());
		$this->assertArrayHasKey('name', $model->getProperties());
		$this->assertTrue(isset($model->getProperties()['name']));
		unset($model->email);
		$this->assertFalse(isset($model->email));

	 }


	 /**
	 * Test to see if a new model instance has unpopulated properties
	 */
	 public function testNewInstanceCreatesInstanceWithoutAttributes()
	 {
		$model = new PersistenceModelStub();

		$this->assertEmpty($model->getProperties());
		$this->assertEquals(0, sizeof($model->getProperties()));
		$this->assertEquals(0, count($model->getProperties()));
		$this->assertArrayNotHasKey('id', $model->getProperties());
	 }


	 /**
	 * Mock the testing of finding a model from the database
	 */
	 public function testModelCanBeFound()
	 {
		$mock = Mockery::mock('Verem\Persistence\Test\PersistenceModelFindStub');
		$mock->shouldReceive('find')
			->with(1)
			->andReturn('foo');

	 }

	 /**
	 * Mock the test for deletion
	 */
	 public function testModelCanBeDeleted()
	 {
		$mock = Mockery::mock('Verem\persistence\Base\Model\PersistenceModelDeleteStub');
		$mock->shouldReceive('destroy')
		  ->with(1)
		  ->once()
		  ->andReturn(true);
	 }
}
