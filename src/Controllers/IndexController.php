<?php

namespace Up\Controllers;

use Exception;
use Up\Cache\FileCache;
use Up\Services\Repository\ProductService;

class IndexController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function indexAction(): string
	{
		$newProducts = ProductService::getNewProducts();
		$params = [
			'addProducts' => [9, 10],
			'newProducts' => $newProducts,
		];

		return $this->render('main', $params);
	}
}