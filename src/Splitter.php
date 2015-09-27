<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/26/15
 * Time: 11:59 AM
 */

namespace Verem\persistence;

class Splitter
{
    private $className;

    public function __construct($className)
    {
        $this->className = $className;
    }

    public function split()
    {
        return  preg_split('/(?=[A-Z])/', $this->className);
    }

    public function toLower()
    {
        $lowerCase = [];
        foreach ($this->split() as $key => $value) {
            $lowerCase[] = strtolower($value);
        }

        return $lowerCase;
    }

    public function format()
    {
        $formattedString =  join('_', $this->toLower());
        if (strpos($formattedString, '_') === 0) {
            $formattedString = substr($formattedString, 1);
        }

        return $formattedString;
    }
}
