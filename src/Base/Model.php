<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/25/15
 * Time: 10:22 PM
 */

namespace Verem\persistence\Base;

use Verem\persistence\Connector;
use PDOException;

abstract class Model extends Connector
{
    private static $className;
    private static $tableName;
    public function __construct()
    {
        $reflection = new \ReflectionClass($this);
        $class = $reflection->getName();
        self::$className = substr(strrchr($class, '\\'), 1);
        self::$tableName = static::getTable();
    }

    /**
     * @return string
     *
     * get the name of the class. This will determine
     * the name of the table
     */
    protected static function getClass()
    {
        return self::$className;
    }


    /**
     * return all records in the database
     */
    public static function all()
    {
        $table = self::$tableName;
        try {
            $statement = static::createConnection();
            return $statement->query("SELECT * FROM {$table}")->fetchAll();
        } catch (PDOException $e) {
            die($e->getMessage());
        } finally {
            $statement = null;
        }
    }

    /**
     * @param array $values
     * @return array
     */
    public function create($values = array())
    {
    }


	/**
	 * @param $id
	 * @return array
	 *
	 * Fetches a model, from the database that
	 * matches the specified $id.
	 */

    public static function find($id)
    {
        $table= self::$tableName;
        $connection = static::createConnection();
        $statement = $connection->prepare("SELECT * FROM {$table} WHERE id = ?");
		$statement->bindParam(1, $id);
		$statement->execute();
		return $statement->fetchAll();
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
    public static function update($id, $values = array())
    {
    }

    /**
     * @param $id
     *
     * Delete a record from the database
     */
    public static function destroy($id)
    {
    }


    /**
     * Split the string at each occurrence of a camel
     * case, add underscores to separate individual
     * words and pluralize the word to agree with
     * the database schema
     *
     * @return mixed
     */
    public static function getTable()
    {
        $splitter = new Splitter(self::getClass());

        $splittedString = $splitter->format();
        return  Inflect::pluralize($splittedString);
    }
}
