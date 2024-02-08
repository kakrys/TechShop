<?php
declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\UserService;

class UserController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function userAction():string
	{
		session_start();
		if (isset($_SESSION['UserEmail']))
		{
			$user = UserService::getUserByEmail($_SESSION['UserEmail']);
			$params = [
				'userEmail' => $user->email,
				'user' => $user,
				'userFullName' => $user->name . ' ' . $user->surname,
			];
			return $this->render('account', $params);
		}

		header('Location: /login/');
	}
}