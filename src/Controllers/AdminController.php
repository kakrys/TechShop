<?php

declare(strict_types=1);

namespace Up\Controllers;

use Core\Http\Request;
use Exception;
use Core\Web\Json;
use JsonException;
use RuntimeException;
use Up\Services\PaginationService;
use Up\Services\Repository\BrandService;
use Up\Services\Repository\OrderService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\TagService;
use Up\Services\Repository\UserService;

class AdminController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function adminAction(): string
	{
		session_start();

		$data = Request::getBody();

		$orderPage = $data['order'] ?? 1;
		$orderPage = (int)$orderPage;

		$profilePage = $data['profile'] ?? 1;
		$profilePage = (int)$profilePage;

		$productPage = $data['product'] ?? 1;
		$productPage = (int)$productPage;

		if (Request::getSession('AdminEmail') !== null)
		{
			$productArray = ProductService::getProductListForAdmin($productPage);
			$pageArray = PaginationService::determinePage($productPage, $productArray['data'] ?? $productArray);
			$productArray = PaginationService::trimPaginationArray($productArray, 10);

			$userArray = UserService::getUserList($profilePage);
			$userPageArray = PaginationService::determinePage($profilePage, $userArray, 5);
			$userArray = PaginationService::trimPaginationArray($userArray, 5);

			$orderArray = OrderService::getOrderList(null, $orderPage);
			$orderPageArray = PaginationService::determinePage($orderPage, $orderArray, 5);
			$orderArray = PaginationService::trimPaginationArray($orderArray, 5);

			$user = UserService::getUserByEmail(Request::getSession('AdminEmail'));
			$tags = TagService::getTagList();
			$brands = BrandService::getBrandList();

			$params = [
				'adminFullName' => $user->name . ' ' . $user->surname,
				'adminEmail' => $user->email,
				'tags' => $tags,
				'brands' => $brands,
				'orders' => $orderArray,
				'products' => $productArray['data'] ?? $productArray,
				'users' => $userArray,
				'profilePage' => $profilePage,
				'productPage' => $productPage,
				'orderPage' => $orderPage,
				'pageArray' => $pageArray,
				'userPageArray' => $userPageArray,
				'orderPageArray' => $orderPageArray,
			];

			return $this->render('admin', $params);
		}

		header('Location: /login/');

		return '';
	}

	/**
	 * @throws Exception
	 */

	public function loginAction(): string
	{
		session_start();
		if (Request::getSession('AdminEmail') !== null)
		{
			header("Location: /admin/");
		}
		if (Request::getSession('UserEmail') !== null)
		{
			header("Location: /account/");
		}

		return $this->render('login', []);
	}

	/**
	 * @throws Exception
	 */
	public function removeProductAction(): void
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['id']))
		{
			$id = $data['id'];
			ProductService::deleteProductByID($id);

			echo Json::encode([
								  'result' => 'Y',
							  ]);
		}
		else
		{
			echo Json::encode([
								  'result' => 'N',
							  ]);
		}
	}

	/**
	 * @throws Exception
	 */
	public function removeUserAction(): void
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['id']))
		{
			$id = $data['id'];
			UserService::deleteUserByID($id);

			echo Json::encode([
								  'result' => 'Y',
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
	public function addProductAction(): string
	{
		error_reporting(E_ALL ^ E_WARNING);
		try
		{
			ProductService::addProduct();

			return $this->render('admin-create-product', []);
		}
		catch (RuntimeException $e)
		{
			$params = [
				'errors' => $e->getMessage(),
			];

			return $this->render('admin-create-product', $params);
		}

	}

	/**
	 * @throws JsonException
	 * @throws Exception
	 */
	public function updateProductAction(): void
	{
		header('Content-Type: application/json');

		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['id']))
		{
			$id = (int)$data['id'];
			$title = (string)$data['title'];
			$price = (float)$data['price'];
			$description = (string)$data['description'];
			$brandId = (int)$data['brand'];
			$tags = (array)$data['tags'];

			$result = ProductService::updateProductByID($id, $title, $price, $description, $brandId, $tags);
			echo Json::encode([
								  'result' => $result > 0 ? 'Y' : 'N',
							  ]);
		}
		else
		{
			echo Json::encode([
								  'result' => 'N',
								  'error' => 'Some problems',
							  ]);
		}
	}

	/**
	 * @throws JsonException
	 * @throws Exception
	 */
	public function changeProductStatus(): void
	{
		header('Content-Type: application/json');

		$input = file_get_contents('php://input');
		$data = Json::decode($input);
		if (isset($data['id']))
		{
			$id = (int)$data['id'];
			$status = (int)$data['status'];
			$result = ProductService::updateProductStatus($id, $status);

			echo Json::encode([
								  'result' => $result > 0 ? 'Y' : 'N',
							  ]);
		}
		else
		{
			echo Json::encode([
								  'result' => 'N',
							  ]);
		}
	}
}