<?php

declare(strict_types=1);

namespace Up\Controllers;

use Core\Web\Json;
use Exception;
use Core\Http\Request;
use JsonException;
use Up\Services\PaginationService;
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
		if (Request::getSession('UserEmail') !== null)
		{
			$requestData = Request::getBody();
			$params = self::getParams($requestData);

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
		$requestData = Request::getBody();
		$arrayKey = array_key_first($requestData);
		$updateField = mb_substr($arrayKey, 3);
		$funcName = 'updateUser' . $updateField;

		if (!UserService::$funcName())
		{
			$warning = "Invalid " . $updateField;
		}

		$params = self::getParams($requestData);
		$params['warning'] = $warning ?? '';

		return $this->render('account', $params);
	}

	/**
	 * @throws JsonException
	 */
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

	/**
	 * @throws Exception
	 */
	private static function getParams(?array $data): array
	{

		$user = UserService::getUserByEmail(Request::getSession('UserEmail'));

		$orderPage = $data['order'] ?? 1;
		$orderPage = (int)$orderPage;

		$wishPage = $data['wish'] ?? 1;
		$wishPage = (int)$wishPage;

		$isWishListNotNull = Request::getSession('wishList') !== null;

		$wishList = $isWishListNotNull ? ProductService::getProductsByIds(Request::getSession('wishList')) : [];

		if ($wishList !== [])
		{
			$wishArray = array_slice($wishList, 9 * ($wishPage - 1), 10);
			$wishPageArray = PaginationService::determinePage($wishPage, $wishArray);
			$wishArray = PaginationService::trimPaginationArray($wishArray);
		}
		else
		{
			$wishArray = [];
			$wishPageArray = [1, 1];

		}

		$orderArray = OrderService::getOrderList($user->id, $orderPage);
		$orderPageArray = PaginationService::determinePage($orderPage, $orderArray, 5);
		$orderArray = PaginationService::trimPaginationArray($orderArray, 5);

		return [
			'userEmail' => $user->email,
			'user' => $user,
			'userFullName' => $user->name . ' ' . $user->surname,
			'orders' => $orderArray,
			'wishesProducts' => $wishArray,
			'orderPageArray' => $orderPageArray,
			'wishPageArray' => $wishPageArray,
			'orderPage' => $orderPage,
			'wishPage' => $wishPage,
		];
	}
}
