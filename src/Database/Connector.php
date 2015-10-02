<?php
/**
 * Created by PhpStorm.
 * @author: Verem Dugeri
 * Date: 9/25/15
 * Time: 10:26 PM
 */

namespace Verem\persistence;

use Dotenv\Dotenv;
use PDOException;
use PDO;
use Verem\EnvReader;

abstract class Connector
{
	/**
	 * @var $dsn
	 * The datasource name for the connection
	 */
    private static $dsn;

	/**
	 * @var $user
	 * The username for the connection.
	 */
	private static $username;

	/**
	 * @var $password
	 * The database password for the connection.
	 */
	private static $password;


	private static $dotEnv;

	/**
	 * constructor to create a class instance
	 */
	public function __construct()
	{
		self::$dotEnv = new EnvReader();
		self::$dotEnv->loadEnv();

		self::$password = getenv('DB_PASSWORD');
		self::$username = getenv('DB_USERNAME');
		self::$dsn 		= getenv('DB_CONNECTION').":host=".getenv('DB_HOST').";dbname=".getenv('DATABASE_NAME');
	}


	public static function createConnection()
	{
		try{
			return new PDO(self::$dsn, self::$username, self::$password);

		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

}
