<?php

namespace Up\Controllers;

use Exception;
use JsonException;

use Core\Web\Json;
use Core\Http\Request;

use Up\Cache\FileCache;
use Up\Services\PaginationService;
use Up\Services\Repository\TagService;
use Up\Services\Repository\BrandService;
use Up\Services\Repository\ProductService;

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
			$sortBy = Request::getSession('sortBy');
			$activeBrands = Request::getSession('activeBrands');
		}
		if (Request::method() === 'POST')
		{
			$activeBrands = $request['activeBrands'] ?? null;
			$_SESSION['activeBrands'] = $activeBrands;

			$sortBy = $request['sortBy'] ?? null;
			$_SESSION['sortBy'] = $sortBy;

		}
		if (Request::getSession('wishList') === null)
		{
			$_SESSION['wishList'] = [];
		}
		$wishList = $_SESSION['wishList'];
		$cache = new FileCache();
		$tags = $cache->remember('tags', 3600, function() {
			return TagService::getTagList();
		});
		$brands = $cache->remember('brands', 3600, function() {
			return BrandService::getBrandList();
		});

		if ($productTitle !== null)
		{
			$productArray = ProductService::getProductsByTitle(
				$pageNumber,
				$productTitle,
				$tagName,
				$activeBrands,
				$sortBy
			);
		}
		else
		{
			//$productArray = ProductService::getProductList($pageNumber, $tagName, $activeBrands, $sortBy);
			if (isset($activeBrands))
			{
				$key = "products$pageNumber$tagName" . implode(array_values($activeBrands)) .  "$sortBy";
			}
			else
			{
				$key = "products$pageNumber$tagName" .  "$sortBy";
			}
			$productArray = $cache->remember($key, 3600, function() use ($pageNumber,$tagName,$activeBrands,$sortBy) {
				return ProductService::getProductList($pageNumber,$tagName,$activeBrands,$sortBy);
			});
		}
		$pageArray = PaginationService::determinePage($pageNumber, $productArray['data'] ?? $productArray);
		if (isset($productArray['data']))
		{
			$productArray['data'] = PaginationService::trimProductArray($productArray['data']);
		}
		else
		{
			$productArray = PaginationService::trimProductArray($productArray);
		}
		$params = [
			'tags' => $tags['data'] ?? $tags,
			'tag' => $tagName,
			'pageNumber' => $pageNumber,
			'products' => $productArray['data'] ?? $productArray,
			'tagName' => $tagName,
			'pageArray' => $pageArray,
			'brandArray' => $brands['data'] ?? $brands,
			'productTitle' => $productTitle,
			'activeBrands' => $activeBrands,
			'sortBy' => $sortBy,
			'wishList' => $wishList ?? [],
			];

		return $this->render('catalog', $params);

	}

	/**
	 * @throws JsonException
	 */
	public static function addWishItemAction(): void
	{
		session_start();
		if (Request::getSession('wishList') === null)
		{
			$_SESSION['wishList'] = [];
		}

		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['id']))
		{
			$id = $data['id'];
			$wishlist = &$_SESSION['wishList'];

			if (in_array($id, $wishlist, true))
			{
				$wishlist = array_diff($wishlist, [$id]);
			}
			else
			{
				$wishlist[] = $id;
			}
			$result = $wishlist;

			echo Json::encode([
								  'result' => $result ? 'Y' : 'N',
							  ]);
		}
		else
		{
			echo Json::encode([
								  'result' => 'N',
								  'error' => 'Id not provided',
							  ]);
		}
	}
}