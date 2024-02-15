<?php

namespace Up\Controllers;

use Up\Services\Repository\ProductService;

class IndexController extends BaseController
{
	public function indexAction(): string
	{
		$newProducts = ProductService::getNewProducts();
		$params = [
			'addProducts' => [9,10],
			'newProducts' => $newProducts,
		];
		return $this->render('main', $params);
	}
}