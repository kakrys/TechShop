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
		$userName = $request['userName'];
		$userSurname = $request['userSurname'];
		$userEmail = $request['email'];
		$userPassword = $request['password'];
		$userAddress = $request['userAddress'];

		if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
		{
			return $this->render('login', ['registerError' => 'Invalid Email']);
		}

		if (UserService::getUserByEmail($userEmail))
		{
			return $this->render('login', ['registerError' => 'User already exists']);
		}

		if (trim($userName) === '' || trim($userPassword) === '' || trim($userSurname) === '' || trim($userAddress) === '')
		{
			return $this->render('login', ['registerError' => 'Fill in all the fields']);
		}

		UserService::addUser($userName,$userSurname,$userEmail,$userPassword,$userAddress);
		$_SESSION['UserEmail'] = $userEmail;
		header('Location: /account/');
	}
}