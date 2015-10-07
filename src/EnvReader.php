<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/28/15
 * Time: 5:22 PM
 *
 * Read environment variables from a
 * .env file
 */

namespace Verem;

use Dotenv\Dotenv;

class EnvReader extends Dotenv {

	/**
	 * @var Dotenv
	 */
	private $dotEnv;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->dotEnv = parent::__construct(__DIR__.'/../');
	}

	/**
	 * @return array
	 *
	 * load the .env file.
	 */
	public function loadEnv()
	{
		return $this->load();
	}
}