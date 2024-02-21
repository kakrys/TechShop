<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Core\Http\Request;
use Up\Services\Repository\OrderService;
use Up\Services\Repository\ProductService;
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

			$wishesProducts = isset($_SESSION['wishList']) ? ProductService::getProductsByIds($_SESSION['wishList']) : [];

			$params = [
				'userEmail' => $user->email,
				'user' => $user,
				'userFullName' => $user->name . ' ' . $user->surname,
				'orders' => $orders,
				'wishesProducts' => $wishesProducts,
			];

			return $this->render('account', $params);
		}

		header('Location: /login/');

		return null;
	}

	/**
	 * @throws Exception
	 */
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
		$wishesProducts = isset($_SESSION['wishList']) ? ProductService::getProductsByIds($_SESSION['wishList']) : [];
		$params = [
			'userEmail' => $user->email,
			'user' => $user,
			'userFullName' => $user->name . ' ' . $user->surname,
			'orders' => $orders,
			'warning' => $warning ?? '',
			'wishesProducts' => $wishesProducts,
		];

		return $this->render('account', $params);
	}
}
