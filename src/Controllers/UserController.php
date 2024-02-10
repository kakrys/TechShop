<?php
declare(strict_types=1);

namespace Up\Controllers;

use Core\Http\Request;
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
	public function updateInfoAction(): void
	{
		session_start();
		$request = Request::getBody();
		$arrayKey = array_key_first($request);
		$updateField = mb_substr($arrayKey,3);
		$funcName = 'updateUser' . $updateField;
		UserService::$funcName();
		header('Location: /account/');
	}
}

// if (isset($request['newName']))
// {
// 	UserService::updateUserName();
// }
// if (isset($request['newSurname']))
// {
// 	UserService::updateUserSurname();
// }
// if (isset($request['newAddress']))
// {
// 	UserService::updateUserAddress();
// }
// if (isset($request['newPassword']))
// {
// 	UserService::updateUserPassword();
// }
// if (isset($request['newEmail']))
// {
// 	UserService::updateUserEmail();
//
// }