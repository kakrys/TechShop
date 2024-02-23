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
		if (!ProductService::getProductInfoByID($id))
		{
			return $this->get404();
		}
		$params = [
			'product' => ProductService::getProductInfoByID($id),
			'id' => $id,
			'images'=>ImageService::selectProductImages($id),
		];

		return $this->render('detail', $params);
	}
}