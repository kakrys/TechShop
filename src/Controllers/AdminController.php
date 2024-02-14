<?php

declare(strict_types=1);

namespace Up\Controllers;

use Core\DB\Migrator;
use Exception;
use Core\Web\Json;
use Up\Cache\FileCache;
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
	public function adminAction($pageNumber): string
	{
		session_start();
		$pageNumber = (int)$pageNumber;
		if (isset($_SESSION['AdminEmail']))
		{
			$productArray = ProductService::getProductListForAdmin($pageNumber);
			$pageArray = PaginationService::determinePage($pageNumber, $productArray);
			$productArray = PaginationService::trimProductArray($productArray);
			$user = UserService::getUserByEmail($_SESSION['AdminEmail']);
			$cache = new FileCache();
			$tags = $cache->remember('tags', 3600,function(){
				return TagService::getTagList();
			});
			$brands = $cache->remember('brands', 3600,function(){
				return BrandService::getBrandList();
			});



			$params = [
				'adminFullName' => $user->name . ' ' . $user->surname,
				'adminEmail' => $user->email,
				'tags' => $tags['data'] ?? $tags ,
				'brands' => $brands['data'] ?? $brands,
				'orders' => OrderService::getOrderList(),
				'products' => $productArray,
				'users' => UserService::getUserList(),
				'pageArray' => $pageArray,
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
		if (isset($_SESSION['AdminEmail']))
		{
			header("Location: /admin/1/");
		}
		if (isset($_SESSION['UserEmail']))
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
			$result = ProductService::deleteProductByID($id);

			echo Json::encode([
								  'result' => $result > 0 ? 'Y' : 'N',
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
	public function removeUserAction(): void
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['id']))
		{
			$id = $data['id'];
			$result = UserService::deleteUserByID($id);

			echo Json::encode([
								  'result' => $result > 0 ? 'Y' : 'N',
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


	public function dbAction(): void
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['title']))
		{
			echo Json::encode([
								  'result' => 'Y',
							  ]);
		}
		else
		{
			echo Json::encode([
								  'result' => 'N',
								  'error' => 'deleteDb not provided',
							  ]);
		}
	}

	public function executeAction(): void
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['title']))
		{
			$result=Migrator::executeMigrations();
			echo Json::encode([
								'result' => $result > 0 ? 'Y' : 'N',
							  ]);
		}
		else
		{
			echo Json::encode([
								  'result' => 'N',
								  'error' => 'executeDb not provided',
							  ]);
		}
	}

	/**
	 * @throws Exception
	 */
	public function addProductAction(): string
	{
		ProductService::addProduct();

		return $this->render('admin-create-product', []);
	}

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

			$result = ProductService::updateProductByID($id, $title, $price, $description);
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
}