<?php

declare(strict_types=1);

namespace Up\Controllers;

use Core\Http\Request;
use Exception;
use Up\Services\AuthenticationService;
use Up\Services\Repository\UserService;

class AuthorizationController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function authAction()
	{
		session_start();

		$request = Request::getBody();
		$user = UserService::getUserByEmail($request['email']);
		if (AuthenticationService::authenticateUser($user, $request['email'], $request['password'],true))
		{
			$_SESSION['AdminId'] = $user->id;
			$_SESSION['AdminEmail'] = $user->email;
			header("Location: /admin/1/");
		}
		if (AuthenticationService::authenticateUser($user, $request['email'], $request['password']))
			{
				$_SESSION['UserId'] = $user->id;
				$_SESSION['UserEmail'] = $user->email;
				header("Location: /account/");
			}
		else
		{
			return $this->render('login', ['authError' => 'Invalid login or password']);
		}
	}

	public function logOutAction(): void
	{
		session_start();
		session_unset();
		header('Location: /');
	}
}

