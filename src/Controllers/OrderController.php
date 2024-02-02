<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\ProductService;

class OrderController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function orderAction($id): string
	{
		$product = ProductService::getProductInfoByID((int)$id);

		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/order', [
				'id' => $id,
				'product' => $product,

			]),
		]);
	}
	public function successAction()
	{
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/success', []),
		]);
	}
}