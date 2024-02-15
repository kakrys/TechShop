<?php

namespace Up\Controllers;

use Core\Http\Request;
use Exception;
use Up\Services\Repository\UserService;

class RegistrationController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function registrationAction()
	{
		session_start();
		$request = Request::getBody();

		if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL))
		{
			return $this->render('login', ['registerError' => 'Invalid Email']);
		}

		if (UserService::getUserByEmail($request['email']))
		{
			return $this->render('login', ['registerError' => 'User already exists']);
		}

		UserService::addUser();
		UserService::getUserByEmail($request['email']);
		$_SESSION['UserEmail'] = $request['email'];
		header('Location: /account/');
	}
}