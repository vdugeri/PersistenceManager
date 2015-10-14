<?php
/**
 * Created by PhpStorm.
 * @author : Verem
 * Date: 10/6/15
 * Time: 10:09 AM
 *
 *Test Stub for finding a model from the database.
 */

namespace Verem\Persistence\Test;

use Mockery;
use Verem\persistence\Base\Model;

class PersistenceModelFindStub extends Model
{
    /**
     * @param $id
     * @return string
     *
     * return a string for test purposes.
     */
     public static function find($id)
     {
         return 'foo';
     }
}
