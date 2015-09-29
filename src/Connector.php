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

abstract class Connector
{
	/**
	 * @var $dsn
	 * The datasource name for the connection
	 */
    private $dsn;

	/**
	 * @var $user
	 * The username for the connection.
	 */
	private $username;

	/**
	 * @var $password
	 * The database password for the connection.
	 */
	private $password;


	private $dotEnv;

	/**
	 * @param $dsn
	 * @param $user
	 * @param $pass
	 *
	 */
	public function __construct()
	{

		$this->dotEnv = new Dotenv(__DIR__.'/../');
		$this->dotEnv->load();

		$this->password = getenv('DB_PASSWORD');
		$this->username = getenv('DB_USERNAME');
		$this->dsn 		= getenv('CONNECTION').":host=".getenv('DB_HOST').";dbname=".getenv('DATABASE_NAME');
	}


	public function createConnection()
	{
		try{
			return new PDO($this->dsn, $this->username, $this->password);
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

}
