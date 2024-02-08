<?php

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\UserService;

class RegistrationController extends BaseController
{
	public function registrationAction()
	{
		session_start();
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			return $this->render('login', ['registerError' => 'Invalid Email']);
		}

		if ($user = UserService::getUserByEmail($_POST['email']))
		{
			return $this->render('login', ['registerError' => 'User already exists']);
		}
		else
		{
			UserService::addUser();
			$_SESSION['UserEmail'] = $_POST['email'];
			header('Location: /account/');
		}
	}
}