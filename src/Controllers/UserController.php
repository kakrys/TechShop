<?php

declare(strict_types=1);

namespace Up\Controllers;

use Core\Http\Request;
use Exception;
use Up\Services\Repository\OrderService;
use Up\Services\Repository\UserService;

class UserController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function userAction(): string|null
	{
		session_start();
		if (isset($_SESSION['UserEmail']))
		{
			$user = UserService::getUserByEmail($_SESSION['UserEmail']);
			$orders = OrderService::getOrderList($_SESSION['UserEmail']);

			$params = [
				'userEmail' => $user->email,
				'user' => $user,
				'userFullName' => $user->name . ' ' . $user->surname,
				'orders' => $orders,
			];

			return $this->render('account', $params);
		}

		header('Location: /login/');
		return null;
	}

	public function updateInfoAction(): string
	{
		session_start();
		$request = Request::getBody();
		$arrayKey = array_key_first($request);
		$updateField = mb_substr($arrayKey, 3);
		$funcName = 'updateUser' . $updateField;

		if (!UserService::$funcName())
		{
			$warning = "Invalid " . $updateField;
		}

		$user = UserService::getUserByEmail($_SESSION['UserEmail']);
		$orders = OrderService::getOrderList($_SESSION['UserEmail']);
		$params = [
			'userEmail' => $user->email,
			'user' => $user,
			'userFullName' => $user->name . ' ' . $user->surname,
			'orders' => $orders,
			'warning' => $warning ?? '',
		];

		return $this->render('account', $params);
		// header('Location: /account/');
	}
}
