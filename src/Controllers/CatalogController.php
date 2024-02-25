<?php

namespace Up\Controllers;

use Exception;
use JsonException;

use Core\Web\Json;
use Core\Http\Request;

use RuntimeException;
use Up\Cache\FileCache;
use Up\Services\PaginationService;
use Up\Services\Repository\TagService;
use Up\Services\Repository\BrandService;
use Up\Services\Repository\ProductService;
use Up\Services\ValidationService;

class CatalogController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function catalogAction(string $tagName, $pageNumber): string
	{
		try
		{
			$request = Request::getBody();

			$pageNumber = substr($pageNumber, 0, 10);

			$productTitle = $request['search'] ?? null;

			session_start();

			if (!is_numeric($pageNumber))
			{
				return $this->get404();
			}

			$activeBrands = $request['activeBrands'] ?? null;

			$sortBy = $request['sortBy'] ?? null;
			$query = http_build_query(['activeBrands' => $activeBrands, 'sortBy' => $sortBy]);
			$data = ($query !== "") ? "?" . $query : null;
			$_SESSION['activeBrands'] = $activeBrands;

			if (Request::getSession('wishList') === null)
			{
				$_SESSION['wishList'] = [];
			}
			$wishList = $_SESSION['wishList'];
			$tags = TagService::getTagList();
			$brands = BrandService::getBrandList();

			if ($productTitle !== null)
			{
				$productTitle = ValidationService::getValidateProductTitle($productTitle);

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
				$productArray = ProductService::getProductList($pageNumber, $tagName, $activeBrands, $sortBy);
			}
			$pageArray = PaginationService::determinePage($pageNumber, $productArray);
			$productArray = PaginationService::trimPaginationArray($productArray);

			$params = [
				'tags' => $tags,
				'tag' => $tagName,
				'pageNumber' => $pageNumber,
				'products' => $productArray,
				'tagName' => $tagName,
				'pageArray' => $pageArray,
				'brandArray' => $brands,
				'productTitle' => $productTitle,
				'activeBrands' => $activeBrands,
				'sortBy' => $sortBy,
				'wishList' => $wishList ?? [],
				'data' => $data
			];

			return $this->render('catalog', $params);
		}
		catch (RuntimeException)
		{
			return $this->get404();
		}

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