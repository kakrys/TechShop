<?php

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\BrandService;
use Up\Services\Repository\ImageService;
use Up\Services\Repository\ProductService;

class DetailController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function detailsAction($id): string
	{
		$product= ProductService::getProductInfoByID($id);
		if (!ProductService::getProductInfoByID($id))
		{
			return $this->get404();
		}
		$brandName=$product->getBrand();
		$brandId=BrandService::getBrandId($brandName);
		$params = [
			'product' => $product,
			'id' => $id,
			'images'=>ImageService::selectProductImages($id),
			'brandId'=>$brandId
		];

		return $this->render('detail', $params);
	}
}