<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/28/15
 * Time: 5:22 PM
 */

namespace Verem;


use Dotenv\Dotenv;

class EnvReader extends Dotenv {

	private $dotEnv;
	public function __construct()
	{
		$this->dotEnv = parent::__construct(__DIR__.'/../');
	}

	public function loadEnv()
	{
		return $this->load();
	}
}