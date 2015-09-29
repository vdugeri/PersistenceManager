<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/25/15
 * Time: 10:22 PM
 */

namespace Verem\persistence\Base;

abstract class Model
{
    private static $className;

    public function __construct()
    {
        $reflection = new \ReflectionClass($this);
        $class = $reflection->getName();
        self::$className = substr(strrchr($class, '\\'), 1);
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
    }

    /**
     * @param array $values
     *
     * create a record in the given table
     */
    public function create($values = array())
    {

        $table = $this->getTable(self::getClass());
    }

    /**
     *
     * @param $id
     * find and return a record from db
     *
     * @return mixed
     */
    public static function find($id)
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
