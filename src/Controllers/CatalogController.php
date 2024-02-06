<?php

namespace Up\Controllers;

use Exception;
use Up\Services\PaginationService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\TagService;

class CatalogController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function catalogAction(string $tagName, $pageNumber): string
	{
		$params = [
			'tags' => TagService::getTagList(),
			'tag' => $tagName,
			'pageNumber' => $pageNumber,
			'products' => ProductService::getProductList($pageNumber, $tagName),
			'tagName'=> $tagName,
			'pageArray'=> PaginationService::determinePage($pageNumber,$tagName)
		];
		return $this->render('catalog', $params);
	}
}