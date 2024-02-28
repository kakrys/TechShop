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
	public function authAction(): null|string
	{
		session_start();

		$request = Request::getBody();
		$user = UserService::getUserByEmail($request['email']);
		if (AuthenticationService::authenticateUser($user, $request['email'], $request['password'], true))
		{
			Request::setSession('AdminEmail',$user->email);
			header("Location: /admin/");
			return null;
		}
		if (AuthenticationService::authenticateUser($user, $request['email'], $request['password']))
		{
			Request::setSession('UserEmail',$user->email);
			header("Location: /account/");
			return null;
		}

		return $this->render('login', ['authError' => 'Invalid login or password']);
	}

	public function logOutAction(): void
	{
		session_start();
		if (Request::getSession('AdminEmail'))
		{
			Request::unsetSessionValue('AdminEmail');
		}
		else
		{
			Request::unsetSessionValue('UserEmail');
		}
		header('Location: /');
	}
}

