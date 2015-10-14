<?php
/**
 * Created by PhpStorm.
 * @author : Verem Dugeri
 * Date: 10/14/15
 * Time: 9:52 AM
 */

namespace Verem\Persistence\Test;

use Verem\Persistence\Base\Model;

/**
* Class PersistenceModelSaveStub
* @package Verem\Persistence\Test
*
* Stub for testing the actual saving of a model to database
*/
class PersistenceModelSaveStub extends Model
{
    protected $properties = [];

    public function save()
    {
        return true;
    }
}
