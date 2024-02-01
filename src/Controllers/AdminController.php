<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\ProductService;

class AdminController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function adminAction($id): string
	{
        $products = ProductService::getProductListForAdmin();
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/admin', [
				'id' => $id,
				'content' => $this->render('/components/admin-list', ['products'=>$products]),
				'adminEdit' => $this->render('/components/admin-edit', []),
			]),
		]);
	}
}