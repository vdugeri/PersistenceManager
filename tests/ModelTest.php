<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/27/15
 * Time: 4:31 PM
 */

namespace Verem\persistence\Test;

use Verem\persistence\UserRole;

class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     *Perform test for models map to database tables
     */
    public function testModelMapsToTable()
    {
        $userRole = new UserRole();
        $this->assertEquals('user_roles', $userRole->getTable());
    }

}
