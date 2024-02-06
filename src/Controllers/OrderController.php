<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\OrderService;
use Up\Services\Repository\ProductService;

class OrderController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function orderAction($id): string
	{
		$params = [
			'id' => $id,
			'product' => ProductService::getProductInfoByID((int)$id),
		];
		return $this->render('order', $params);
	}

	/**
	 * @throws Exception
	 */
	public function successAction(): string
	{
		$params = [
			'orderErrors' => OrderService::addOrder(),
		];
		return $this->render('success', $params);
	}
}