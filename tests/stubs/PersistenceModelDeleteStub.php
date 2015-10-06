<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/6/15
 * Time: 10:45 AM
 */

namespace Verem\Persistence\Test;


use Verem\persistence\Base\Model;

class PersistenceModelDeleteStub extends Model {


	public static function destroy($id)
	{
		return true;
	}
}