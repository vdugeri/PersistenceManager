<?php
/**
 * Created by PhpStorm.
 * @author : Verem Dugeri
 * Date: 9/29/15
 * Time: 10:34 AM
 */

namespace Verem\persistence;


use Dotenv\Dotenv;

class EnvReader {

	private $dotenv;
	public function __construct()
	{
		$this->dotenv = new Dotenv(__DIR__.'/../');
	}

	public function load()
	{
		return $this->dotenv->load();
	}

}