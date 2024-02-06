<?php
declare(strict_types=1);

namespace Up\Controllers;

use Exception;

class UserController extends BaseController
{
	public function userAction():string
	{
		$params = [];
		return $this->render('account', $params);
	}
}