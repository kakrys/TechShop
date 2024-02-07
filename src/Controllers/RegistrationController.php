<?php

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\UserService;

class RegistrationController extends BaseController
{
	public function registrationAction():void
	{
		session_start();
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['registerError'] = 'Invalid Email';
			header('Location: /login/');
		}
		elseif (UserService::getUserByEmail($_POST['email']))
		{
			$_SESSION['registerError'] = 'User already exists';
			header('Location: /login/');
		}
		else
		{
			UserService::addUser();
			$_SESSION['UserEmail'] = $_POST['email'];
			header('Location: /account/');
		}
	}
}