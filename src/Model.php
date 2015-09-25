<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/25/15
 * Time: 10:22 PM
 */

namespace Verem\persistence;

abstract class Model
{
    public function __construct()
    {
    }


    public function all()
    {
    }

    public function create($table, $values = array())
    {
    }
    public function find($id)
    {
    }


    public function where($column, $value)
    {
    }

    public function update($id, $value = array())
    {
    }

    public function destroy($id)
    {
    }
}
