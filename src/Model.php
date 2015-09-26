<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/25/15
 * Time: 10:22 PM
 */

namespace Verem\persistence;

abstract class Model
{
	private $class;

    public function __construct()
    {
		$reflection = new \ReflectionClass($this);
		$this->class = $reflection->getName();
    }

	/**
	 * @return string
	 *
	 * get the name of the class. This will determine
	 * the name of the table
	 */
	protected function getClass()
	{
		return $this->class;
	}


	/**
	 * return all records in the database
	 */
    public static function all()
    {

    }

	/**
	 * @param array $values
	 *
	 * create a record in the given table
	 */
    public function create($values = array())
    {
		//TODO: change this to get the name of the table
		//TODO: with camel cases splited to underscores
		//TODO: and the name of the class pluralised.

		$table = $this->getTable($this->getClass());
    }

	/**
	 * @param $id
	 *
	 * find and return a record from db
	 */

	protected function getTable($class)
	{
		$table = strtolower($this->class);
		return $table;
	}
    public function find($id)
    {
    }

	/**
	 * @param $column
	 * @param $value
	 *
	 * find all records where column matches value
	 */
    public function where($column, $value)
    {
    }

	/**
	 * @param $id
	 * @param array $values
	 *
	 * Update a row in the db with a matching id
	 */
    public function update($id, $values = array())
    {
    }

	/**
	 * @param $id
	 *
	 * Delete a record from the database
	 */
    public function destroy($id)
    {
    }
}
