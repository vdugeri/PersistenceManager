<?php
/**
 * Created by PhpStorm.
 * @author: Verem Dugeri
 * Date: 9/25/15
 * Time: 10:26 PM
 */

namespace Verem\persistence;

abstract class Database
{
    private $dbConnection;
    public function __construct($connection, $user = '', $password = '', $db='test', $host='')
    {
        $this->initConnection($connection, $user, $password, $db, $host);
    }



    protected function initConnection($connection, $user, $password, $db, $host)
    {
        switch ($connection) {
            case 'mysql':
                $dsn = "mysql:host={$host};dbname={$db}";
                try {
                    $dbh = new \PDO($dsn, $user, $password);
                } catch (\PDOException $exception) {
                    return "Error: {$exception->getMessage()}";
                }

                $this->dbConnection = $dbh;
                break;

            case 'pgsql':
                //TODO: connect to PgSQL and return an instance
                break;

            case 'sqlite':
                try {
                    $dbh = new \PDO("sqlite:{$db}");
                } catch (\PDOException $e) {
                    return "Error: {$e->getMessage()}";
                }

                $this->dbConnection = $dbh;
                break;
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }

    public function setTableName($table)
    {
    }
}
