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
		try
		{
			session_start();
			$request = Request::getBody();
			$userName = $request['userName'];
			$userSurname = $request['userSurname'];
			$userEmail = $request['email'];
			$userPassword = $request['password'];
			$userAddress = $request['userAddress'];

			ValidationService::getRegisterError(
				$userName,
				$userSurname,
				$userEmail,
				$userPassword,
				$userAddress
			);
			UserService::addUser($userName, $userSurname, $userEmail, $userPassword, $userAddress);
			Request::setSession('UserEmail', $userEmail);
			header('Location: /account/');
		}
		catch (\RuntimeException $e)
		{
			return $this->render('login', ['registerError' => $e->getMessage()]);
		}
	}
}