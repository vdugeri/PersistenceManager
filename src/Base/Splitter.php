<?php
/**
 * This class splits the name of a class, takes
 * only the name of the class leaving out the namespace,
 * and adds underscores to the name of the class.
 *
 * Created by PhpStorm.
 * @author: Verem Dugeri
 * Date: 9/26/15
 * Time: 11:59 AM
 */

namespace Verem\Persistence\Base;

class Splitter
{
     /**
     * @var $className
     */
	 private $className;

     /**
     * @param $className
     */
     public function __construct($className)
     {
         $this->className = $className;
     }

     /**
     * Split the word at every occurence of an
     * uppercase letter.
     *
     * @return array
     */
     public function split()
     {
         return  preg_split('/(?=[A-Z])/', $this->className);
     }

     /**
     * convert the input string to its lowercase
     * version.
     *
     * @return array
     */
     public function toLower()
     {
         $lowerCase = [];
         foreach ($this->split() as $key => $value) {
             $lowerCase[] = strtolower($value);
         }

         return $lowerCase;
     }

     /**
     * Format the string, remove any trailing underscores
     * that might be added to the beginning of the name.
     *
     * @return string
     */
     public function format()
     {
         $formattedString =  join('_', $this->toLower());
         if (strpos($formattedString, '_') === 0) {
             $formattedString = substr($formattedString, 1);
         }

         return $formattedString;
     }
}
