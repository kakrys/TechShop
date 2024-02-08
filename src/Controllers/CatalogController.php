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
		$productArray = ProductService::getProductList($pageNumber, $tagName);
		$pageArray = PaginationService::determinePage($pageNumber,$productArray);
		$productArray = PaginationService::trimProductArray($productArray);
		$params = [
			'tags' => TagService::getTagList(),
			'tag' => $tagName,
			'pageNumber' => $pageNumber,
			'products' => $productArray,
			'tagName'=> $tagName,
			'pageArray'=> $pageArray
		];
		return $this->render('catalog', $params);
	}
	public function searchAction(string $tagName, $pageNumber,$mask): string
	{
		$productTitle = $_GET['search'];
		$productArray = ProductService::getProductsByTitle($pageNumber,$productTitle);
		$pageArray = PaginationService::determinePage($pageNumber,$productArray);
		$productArray = PaginationService::trimProductArray($productArray);
		$params = [
			'tags' => TagService::getTagList(),
			'tag' => $tagName,
			'pageNumber' => $pageNumber,
			'products' => $productArray,
			'tagName'=> $tagName,
			'pageArray'=> $pageArray,
			'productTitle'=>$productTitle
		];
		return $this->render('search-catalog', $params);
	}
}