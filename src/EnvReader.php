<?php
/**
 * Created by PhpStorm.
 * @author : Verem Dugeri
 * Date: 9/28/15
 * Time: 5:22 PM
 *
 * Read environment variables from .env
 */

namespace Verem;

use Dotenv\Dotenv;

class EnvReader extends Dotenv
{
    /**
     * Constructor
     *
     * Call the parent class and pass it the
     * root directory as the argument.
     */
     public function __construct()
     {
         parent::__construct($_SERVER['DOCUMENT_ROOT']);
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
