<?php

namespace Up\Controllers;

use Core\Http\Request;
use Exception;
use Up\Cache\FileCache;
use Up\Services\PaginationService;
use Up\Services\Repository\BrandService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\TagService;

class CatalogController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function catalogAction(string $tagName, $pageNumber): string
	{
		$request = Request::getBody();
		$productTitle = $request['search'] ?? null;
		session_start();
		if (Request::method() === 'GET')
		{
			$sortBy=Request::getSession('sortBy');
			$activeBrands = Request::getSession('activeBrands');
		}
		if (Request::method() === 'POST')
		{
			$activeBrands = $request['activeBrands'] ?? null;
			$_SESSION['activeBrands'] = $activeBrands;

			$sortBy = $request['sortBy'] ?? null;
			$_SESSION['sortBy'] =$sortBy;

		}
		$cache = new FileCache();
		$tags = $cache->remember('tags', 3600, function() {
			return TagService::getTagList();
		});
		$brands = $cache->remember('brands', 3600, function() {
			return BrandService::getBrandList();
		});

		if ($productTitle !== null)
		{
			$productArray = ProductService::getProductsByTitle($pageNumber, $productTitle, $tagName, $activeBrands);
		}
		else
		{
			$productArray = ProductService::getProductList($pageNumber, $tagName, $activeBrands);
		}
		$pageArray = PaginationService::determinePage($pageNumber, $productArray);
		$productArray = PaginationService::trimProductArray($productArray);
		$params = [
			'tags' => $tags['data'] ?? $tags,
			'tag' => $tagName,
			'pageNumber' => $pageNumber,
			'products' => $productArray,
			'tagName' => $tagName,
			'pageArray' => $pageArray,
			'brandArray' => $brands['data'] ?? $brands,
			'productTitle' => $productTitle,
			'activeBrands' => $activeBrands,
			'sortBy'=>$sortBy,
		];

		return $this->render('catalog', $params);

	}
}