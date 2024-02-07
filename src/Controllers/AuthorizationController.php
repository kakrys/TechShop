<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Up\Services\AuthenticationService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\UserService;

class AuthorizationController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function authAction(): void
	{
		session_start();
		$user = UserService::getUserByEmail($_POST['email']);
		if (AuthenticationService::authenticateUser($user,$_POST['email'],$_POST['password'],true))
		{
			$_SESSION['AdminId']=$user->id;
			$_SESSION['AdminEmail']=$user->email;
			header("Location: /admin/");
			unset($_SESSION['AuthError']);
		}
		if (AuthenticationService::authenticateUser($user,$_POST['email'],$_POST['password'],false))
			{
				$_SESSION['UserId']=$user->id;
				$_SESSION['UserEmail']=$user->email;
				header("Location: /account/");
				unset($_SESSION['AuthError']);
			}
		else{
			$_SESSION['AuthError'] = 'Invalid login or password';
			header('Location: /login/');
		}
	}

	public function logOutAction(): void
	{
		session_start();
		session_unset();
		header('Location: /');
	}
}

