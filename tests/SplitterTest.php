<?php
/**
 * Created by PhpStorm.
 * @author : Verem Dugeri
 * Date: 9/29/15
 * Time: 1:21 PM
 */

namespace Verem\Persistence\Test;

use Verem\Persistence\Base\Splitter;

class SplitterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $expected
     * @param $actual
     *
     * @dataProvider nameProvider
     */
     public function testClassNameIsSplitted($expected, $actual)
     {
         $splitter = new Splitter($actual);
         $this->assertEquals($expected, $splitter->format());
     }


    public function nameProvider()
    {
        return [
            ['user_profile', 'UserProfile'],
            ['user_role', 'UserRole'],
            ['profile', 'Profile'],
            ['comment', 'Comment'],
            ['todo_list', 'TodoList']
        ];
    }
}
