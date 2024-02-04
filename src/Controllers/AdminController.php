<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Up\Models\Product;
use Up\Services\AuthenticationService;
use Up\Services\Repository\BrandService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\TagService;
use Up\Services\Repository\UserService;
use Core\Web\Json;

class AdminController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function adminAction($id): string
	{
		session_start();
		if (isset($_SESSION['AdminEmail']))
		{
			$products = ProductService::getProductListForAdmin();
			$user = UserService::getUserByEmail($_SESSION['AdminEmail']);
            $tags=TagService::getTagList();
            $brands=BrandService::getBrandList();
			return $this->render('layout', [
				'modal' => $this->render('/components/modals', []),
				'page' => $this->render('/pages/admin', [
					'id' => $id,
					'adminFullName' => $user->name . ' ' . $user->surname,
					'adminEmail' => $user->email,
					'productList' => $this->render('/components/admin-list', ['products' => $products]),
					'adminEdit' => $this->render('/components/admin-edit', []),
					'orders' => $this->render('/components/admin-orders', []),
					'users' => $this->render('/components/admin-users', []),
					'create' => $this->render('/components/admin-create', ['tags'=>$tags,'brands'=>$brands]),
					'deleteData' => $this->render('/components/admin-clear', []),
				]),
			]);
		}
		else
		{
			header('Location: /login/');
		}
	}

	/**
	 * @throws Exception
	 */
	public function loginAction()
	{
		session_start();
		if (isset($_SESSION['AdminId']))
		{
			header("Location: /admin/{$_SESSION['AdminId']}/");
		}
		$error = $_SESSION['AuthError'] ?? '';
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/login', [
				'error' => $error ,
			]),
		]);

	}
	public function removeAction(): void
	{
		//coming soon...
		//$delete = RemoveService::delete();
		//echo Json::encode([
			//'result' => $delete > 0 ? 'Y' : 'N',
		//]);
		echo Json::encode([
			'result' => 'Y',
		]);
	}
    public function addProductAction():void
    {

    }
}

