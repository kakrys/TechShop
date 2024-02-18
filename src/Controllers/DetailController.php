<?php

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\ImageService;
use Up\Services\Repository\ProductService;

class DetailController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function detailsAction($id): string
	{
		$params = [
			'product' => ProductService::getProductInfoByID($id),
			'id' => $id,
			'images'=>ImageService::selectProductImages($id),
		];

		return $this->render('detail', $params);
	}
}