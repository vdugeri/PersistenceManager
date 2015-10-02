<?php
/**
 * Created by PhpStorm.
 * @author: Verem Dugeri
 * Date: 9/25/15
 * Time: 10:22 PM
 */

namespace Verem\persistence\Base;

use PDO;
use PDOException;
use ReflectionClass;
use Verem\persistence\Connector;
use Verem\Persistence\Exceptions\DatabaseException;

abstract class Model extends Connector
{
    private static $className;
    protected static $tableName;
    protected static $properties = [];
    protected static $primaryKey = 'id';


    public function __construct()
    {
        $reflection        =    new ReflectionClass($this);
        $class             =    $reflection->getName();
        self::$className   =    substr(strrchr($class, '\\'), 1);
        self::$tableName   =    static::getTable();
        parent::__construct();
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
            $connection = static::createConnection();
            return $connection->query("SELECT * FROM {$table}")->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        } finally {
            $connection = null;
        }
    }

    /**
     * @return array
     */
    public function save()
    {
		if($this->exists()){
			$this->performUpdate();
		} else {
			$this->performInsert();
		}
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
        $result = null;
        $connection = null;

        try {
            $connection = static::createConnection();
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        }

        try {
            $statement = $connection->prepare("SELECT * FROM {$table} WHERE id = ?");

            if ($statement) {
                $statement->bindParam(1, $id);
                $statement->execute();
                $result   =  $statement->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        } finally {
            $statement   = null;
            $connection  = null;
        }
        return $result;
    }


    /**
     * @param $column
     * @param $value
     * @return array
     *
     * find all records where column matches value
     */
    public static function where($column, $value)
    {
        $table = self::$tableName;
        $statement  = null;
        $connection = null;
        $result     = null;

        try {
            $connection = static::createConnection();
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        }

        try {
            $statement = $connection->prepare("SELECT * FROM {$table} WHERE {$column} = ?");

            if ($statement) {
                $statement->bindParam(1, $value);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        } finally {
            $statement    = null;
            $connection   = null;
        }
        return $result;
    }

    /**
     * Update a row in the db with a matching id
     *
     * @return int
     */
    public function performUpdate()
    {
        $table = self::$tableName;
        $columns = implode(",", array_keys(self::$properties));
        $values = implode(",", array_values(self::$properties));
        $result = 0;

        try {
            $connection = static::createConnection();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        try {
            $rowCount = $connection->exec("INSERT INTO {$table} ({$columns}) VALUES({$values})");
            if ($rowCount > 0) {
                $result = $rowCount;
            }
        } catch (PDOException $e) {
           return $e->getMessage();
        }
        return $result;
    }

    /**
     * @param $id
     * @return int
     *
     * Delete a record from database
     */
    public static function destroy($id)
    {
        $table = self::$tableName;
        $rowCount = 0;

        try {
            $connection = static::createConnection();
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        }

        try {
            $statement = $connection->prepare("DELETE FROM {$table} WHERE ID = ?");
            if ($statement) {
                $statement->bindParam(1, $id);
                $statement->execute();
                $rowCount = $statement->rowCount();
            }
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        } finally {
            $statement    = null;
            $connection = null;
        }
        return $rowCount;
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

    /**
     * @param $property
     * @param $value
     *
     * Magic method for setting the value of
     * a property conjured out of thin air.
     */
    public function __set($property, $value)
    {
        self::$properties[$property] = $value;
    }

    /**
     * @param $property
     * @return mixed
     *
     * Magic method for getting the value of a property
     * whose name was just concocted from nowhere.
     */
    public function __get($property)
    {
        return self::$properties[$property];
    }

    private function getProperties()
    {
        return static::$properties;
    }

    public function performInsert()
    {
        $table   =  self::$tableName;
        $result = null;
        try {
            $connection =  static::createConnection();
        } catch (PDOException $e) {
            throw new DatabaseException($e);
        }

        try {
            $sql = "INSERT INTO $table ( ";
            $insertColumns = "";
            $insertValues = "";
            $count = 0;

            foreach ($this->getProperties() as $key => $value) {
				$count++;
				if($key === self::$primaryKey) {
					continue;
				}
                $insertColumns .= $key;
                $insertValues  .= ':'.$key;

                if ($count < count($this->getProperties())) {
                    $insertColumns  .= ", ";
                    $insertValues   .= ", ";
                }
            }

            $sql .= $insertColumns .") VALUES (".$insertValues .")";


            $statement = $connection->prepare($sql);
            foreach ($this->getProperties() as $key => $value) {
                $statement->bindParam(":".$key, $value);
            }

            $result = $statement->execute();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function exists()
    {
        if (isset($this->properties) && isset($this->properties['primaryKey'])
                && is_numeric($this->properties['primaryKey'])) {
            return true;
        } else {
            return false;
        }
    }
}
