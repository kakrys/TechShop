<?php

declare(strict_types=1);

namespace Up\Controllers;

use Core\Web\Json;
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
			$orders = OrderService::getOrderList($user->id);

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
		$orders = OrderService::getOrderList($user->id);
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

	public function removeWishItemAction(): void
	{
		session_start();
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['id']))
		{
			$id = $data['id'];
			$wishlist = &$_SESSION['wishList'];

			if (in_array($id, $wishlist, true))
			{
				$wishlist = array_diff($wishlist, [$id]);
			}

			$result = $wishlist;

			echo Json::encode([
				'result' => $result ? 'Y' : 'N',
			]);
		}
		else
		{
			echo Json::encode([
				'result' => 'N',
				'error' => 'Id not provided',
			]);
		}
	}
}
