<?php

namespace Up\Controllers;

use Core\Http\Request;
use Exception;
use Up\Services\Repository\UserService;
use Up\Services\ValidationService;

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

		$registerError = ValidationService::getRegisterError(
			$userName,
			$userSurname,
			$userEmail,
			$userPassword,
			$userAddress
		);
		if ($registerError !== null)
		{
			return $this->render('login', ['registerError' => $registerError]);
		}

		UserService::addUser($userName, $userSurname, $userEmail, $userPassword, $userAddress);
		$_SESSION['UserEmail'] = $userEmail;
		header('Location: /account/');
	}
}